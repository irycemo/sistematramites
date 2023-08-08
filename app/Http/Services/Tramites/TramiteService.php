<?php

namespace App\Http\Services\Tramites;

use App\Models\Tramite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Services\LineasDeCaptura\LineaCaptura;
use App\Http\Services\SistemaRPP\SistemaRppService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TramiteService{

    public $tramite;
    public $fecha_vencimiento;
    public $orden_de_pago;
    public $linea;

    public function __construct(Tramite $tramite)
    {

        $this->tramite = $tramite;

        if($tramite->adiciona != null){

            $this->tramite->movimiento_registral = $tramite->adicionaAlTramite->movimiento_registral;

        }

    }

    public function crear():Tramite
    {

        $this->tramite->numero_control = Tramite::max('numero_control') + 1;

        $this->procesarLineaCaptura();

        $this->tramite->limite_de_pago = $this->fecha_vencimiento;
        $this->tramite->orden_de_pago = $this->orden_de_pago;
        $this->tramite->linea_de_captura = $this->linea;
        $this->tramite->estado = 'nuevo';
        $this->tramite->monto = $this->calcularMonto();
        $this->tramite->creado_por = auth()->user()->id;

        if($this->tramite->solicitante == 'Oficialia de partes'){

            $this->tramite->fecha_pago = now()->toDateString();

            $this->tramite->fecha_entrega = $this->calcularFechaEntrega();

        }

        $this->tramite->save();

        return $this->tramite;

    }

    public function actualizar():void
    {

        DB::transaction(function () {

            if(!$this->tramite->adiciona)
                $this->tramite->numero_paginas = 0;

            $this->tramite->actualizado_por = auth()->user()->id;
            $this->tramite->save();

            if($this->tramite->fecha_pago)
                (new SistemaRppService())->actualizarSistemaRpp($this->tramite);

        });

    }

    public function borrar($id):void
    {

        Tramite::destroy($id);

    }

    public function procesarLineaCaptura():void
    {

        if($this->tramite->solicitante == 'Oficialia de partes'){

            $this->orden_de_pago = 0;

            $this->linea = 0;

            $this->fecha_vencimiento = now()->toDateString();

            $this->tramite->fecha_prelacion = now()->toDateString();

            return;

        }

        $array = (new LineaCaptura($this->tramite))->generarLineaDeCaptura();

        $this->orden_de_pago = $array['SOAPBody']['ns0MT_ServGralLC_PI_Receiver']['ES_OPAG']['NRO_ORD_PAGO'];

        $this->linea = $array['SOAPBody']['ns0MT_ServGralLC_PI_Receiver']['ES_OPAG']['LINEA_CAPTURA'];

        $this->fecha_vencimiento = $this->convertirFecha($array['SOAPBody']['ns0MT_ServGralLC_PI_Receiver']['ES_OPAG']['FECHA_VENCIMIENTO']);

    }

    public function convertirFecha($fecha):string
    {

        if(Str::length($fecha) == 10)
            return $fecha;

        return Str::substr($fecha, 0, 4) . '-' . Str::substr($fecha, 4, 2) . '-' . Str::substr($fecha, 6, 2);

    }

    public function calcularMonto():float
    {

        $monto = 0;

        if($this->tramite->foraneo){

            $monto = 1865 + (float)$this->tramite->monto;

        }elseif($this->tramite->solicitante == 'Oficialia de partes'){

            $monto = 0;

        }else{

            $monto = (float)$this->tramite->monto;

        }

        return $monto;

    }

    public function calcularFechaEntrega():string
    {

        if($this->tramite->tipo_servicio == 'ordinario'){

            $actual = now();

            for ($i=0; $i < 5; $i++) {

                $actual->addDays(1);

                while($actual->isWeekend()){

                    $actual->addDay();

                }

            }

            return $actual->toDateString();

        }elseif($this->tramite->tipo_servicio == 'urgente'){

            $actual = now()->addDays(1);

            while($actual->isWeekend()){

                $actual->addDay();

            }

            return $actual->toDateString();

        }else{

            return now()->toDateString();

        }

    }

    public function procesarPago($fecha, $documento)
    {

        $this->tramite->update([
            'estado' => 'pagado',
            'fecha_pago' => $this->convertirFecha($fecha),
            'fecha_prelacion' => $this->convertirFecha($fecha),
            'documento_de_pago' => $documento,
            'fecha_entrega' => $this->calcularFechaEntrega()
        ]);

        if($this->tramite->adiciona){

            if($this->tramite->adicionaAlTramite->servicio->clave_ingreso == 'DC93'){

                $tramiteAdiciona = Tramite::find($this->tramite->adiciona);

                if(!$tramiteAdiciona)
                    throw new ModelNotFoundException("No se encontro el trámite al que adiciona.");

                $tramiteAdiciona->update([
                    'estado' => 'pagado',
                    'fecha_pago' => $this->convertirFecha($fecha),
                    'fecha_prelacion' => $this->convertirFecha($fecha),
                    'documento_de_pago' => $documento
                ]);

            }else{

                (new SistemaRppService())->actualizarSistemaRpp($this->tramite);

                return;

            }

        }

        (new SistemaRppService())->insertarSistemaRpp($this->tramite);

    }

    public function cambiarEstado($estado)
    {

        try {

            $this->tramite->update(['estado' => $estado]);

            $tramite = $this->tramite;

            $tramite->load('adicionaAlTramite');

            while($tramite->adicionaAlTramite != null){

                if($tramite->adicionaAlTramite->servicio->clave_ingreso == 'DC93' && $estado != 'pagado')
                    break;

                $tramite->adicionaAlTramite->update(['estado' => $estado]);

                $tramite = $tramite->adicionaAlTramite;

            }

            if($estado != 'pagado'){

                $tramites = Tramite::where('adiciona', $this->tramite->id)
                                        ->where('estado', '!=', 'nuevo')
                                        ->get();

                foreach($tramites as $item)
                    $item->update(['estado' => $estado]);

            }

        } catch (\Throwable $th) {
            Log::error("Error al actualizar estado en tramiteService " . $th);
        }

    }

}

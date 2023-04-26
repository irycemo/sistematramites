<?php

namespace App\Http\Services\Tramites;

use App\Models\Tramite;
use Illuminate\Support\Str;
use App\Http\Services\LineasDeCaptura\LineaCaptura;

class TramiteService{


    public $tramite;
    public $fecha_vencimiento;
    public $orden_de_pago;
    public $linea;

    public function __construct(Tramite $tramite)
    {
        $this->tramite = $tramite;

        if($tramite->adiciona == null){

            $this->procesarLineaCaptura();

        }else{

            $this->orden_de_pago = $tramite->adicionaAlTramite->orden_de_pago;
            $this->linea = $tramite->adicionaAlTramite->linea_de_captura;
            $this->fecha_vencimiento = $tramite->adicionaAlTramite->limite_de_pago;
            $this->tramite->movimiento_registral = $tramite->adicionaAlTramite->movimiento_registral;

        }
    }

    public function crear(){

        $this->tramite->numero_control = $this->obtenerNumeroControl();
        $this->tramite->limite_de_pago = $this->fecha_vencimiento;
        $this->tramite->orden_de_pago = $this->orden_de_pago;
        $this->tramite->linea_de_captura = $this->linea;
        $this->tramite->estado = 'pagado'; //Estado
        $this->tramite->fecha_entrega = $this->calcularFechaEntrega();
        //$this->tramite->fecha_prelacion = now(); //Prelacion
        $this->tramite->monto = $this->calcularMonto();
        $this->tramite->creado_por = auth()->user()->id;

        $this->tramite->save();

        return $this->tramite;

    }

    public function actualizar(){

        $this->tramite->monto = $this->calcularMonto();
        $this->tramite->actualizado_por = auth()->user()->id;

        $this->tramite->save();

    }

    public function borrar($id){

        Tramite::destroy($id);

    }

    public function obtenerNumeroControl()
    {
        return Tramite::max('numero_control') + 1;
    }

    public function procesarLineaCaptura(){

        $array = (new LineaCaptura($this->tramite))->generarLineaDeCaptura();

        $this->orden_de_pago = $array['SOAPBody']['ns0MT_ServGralLC_PI_Receiver']['ES_OPAG']['NRO_ORD_PAGO'];

        $this->linea = $array['SOAPBody']['ns0MT_ServGralLC_PI_Receiver']['ES_OPAG']['LINEA_CAPTURA'];

        $this->fecha_vencimiento = $this->convertirFechaVencimieto($array['SOAPBody']['ns0MT_ServGralLC_PI_Receiver']['ES_OPAG']['FECHA_VENCIMIENTO']);

    }

    public function convertirFechaVencimieto($fecha){

        return Str::substr($fecha, 0, 4) . '-' . Str::substr($fecha, 4, 2) . '-' . Str::substr($fecha, 6, 2);

    }

    public function calcularMonto(){

        $monto = 0;

        if($this->tramite->foraneo){

            $monto = 1865 + (int)$this->tramite->monto;

        }else{

            $monto = (int)$this->tramite->monto;

        }

        if($this->tramite->numero_paginas != null){

            $monto = $monto * (int)$this->tramite->numero_paginas;

        }

        return $monto;

    }

    public function calcularFechaEntrega(){

        if($this->tramite->tipo_servicio == 'ordinario'){

            return now()->addDays(4)->toDateString();

        }elseif($this->tramite->tipo_servicio == 'urgente'){

            return now()->addDays(1)->toDateString();

        }else{

            return now()->toDateString();

        }

    }

}

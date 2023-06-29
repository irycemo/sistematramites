<?php

namespace App\Http\Services\Tramites\TramitesStrategies;

use App\Models\Tramite;
use App\Models\Servicio;
use App\Http\Services\Tramites\TramiteService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Services\Tramites\TramitesStrategyInterface;

class Certificaciones implements TramitesStrategyInterface{

    public function __construct(public Tramite $tramite){}

    public function cambiarFlags(array $flags):array
    {

        $flags['solicitante'] = true;
        $flags['tipo_servicio'] = true;
        $flags['seccion'] = true;
        $flags['distrito'] = true;

        if($this->tramite->servicio->clave_ingreso == 'DL14' || $this->tramite->servicio->clave_ingreso == 'DL13'){

            $flags['numero_paginas'] = true;
            $flags['tomo'] = true;
            $flags['registro'] = true;
            $flags['adiciona'] = true;
            $flags['observaciones'] = true;

            return $flags;

        }else{

            return $flags;

        }

    }

    public function crearTramite():Tramite
    {

        $this->tramite->load('servicio');

        if($this->tramite->servicio->clave_ingreso == 'DL13' || $this->tramite->servicio->clave_ingreso == 'DL14'){

            if($this->tramite->adiciona == null){

                $consulta = $this->crearTramiteConsulta();

                $this->tramite->adiciona = $consulta->id;

                $this->tramite->monto = $this->tramite->monto + $consulta->monto;

                $tramite = (new TramiteService($this->tramite))->crear();

                $tramite->save();

                $this->tramite->load('servicio.categoria');

                return $this->tramite;

            }else{

                $tramite = (new TramiteService($this->tramite))->crear();

                return $tramite;

            }

        }

        $tramite = (new TramiteService($this->tramite))->crear();

        $this->tramite->load('servicio.categoria');

        return $tramite;

    }

    public function validaciones():array
    {

        if($this->tramite->servicio->clave_ingreso == 'DL14' || $this->tramite->servicio->clave_ingreso == 'DL13'){

            return [
                'modelo_editar.seccion' => 'required',
                'modelo_editar.distrito' => 'required',
                'modelo_editar.tomo' => 'required',
                'modelo_editar.registro' => 'required',
                'modelo_editar.nombre_solicitante' => 'required',
                'modelo_editar.numero_paginas' => 'required',
                'modelo_editar.numero_oficio' => $this->tramite->solicitante == 'Oficialia de partes' ? 'required' : 'nullable'
            ];

        }else{

            return [
                'modelo_editar.seccion' => 'required',
                'modelo_editar.distrito' => 'required',
                'modelo_editar.nombre_solicitante' => 'required',
            ];

        }

    }

    public function crearTramiteConsulta():Tramite
    {

        $servicio = Servicio::where('clave_ingreso', 'DC93')->first();

        if(!$servicio){

            throw new ModelNotFoundException("Error al encontrar el servcio DC93");

        }

        $consulta = Tramite::make();
        $consulta->id_servicio = $servicio->id;
        $consulta->estado = 'nuevo';
        $consulta->tipo_servicio = 'ordinario';
        $consulta->monto = $this->tramite->solicitante == 'Oficialia de partes' ? 0 : $servicio->ordinario;
        $consulta->fecha_entrega = $this->tramite->fecha_entrega;
        $consulta->solicitante = $this->tramite->solicitante;
        $consulta->nombre_solicitante = $this->tramite->nombre_solicitante;
        $consulta->distrito = $this->tramite->distrito;
        $consulta->seccion = $this->tramite->seccion;

        return (new TramiteService($consulta))->crear();

    }

}

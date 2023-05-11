<?php

namespace App\Http\Services\Tramites\TramitesStrategies;

use App\Models\Tramite;
use App\Models\Servicio;
use App\Http\Services\Tramites\TramiteService;
use App\Http\Services\SistemaRPP\SistemaRppService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Services\Tramites\TramitesStrategyInterface;

class Certificaciones implements TramitesStrategyInterface{

    public $tramite;

    public function __construct(Tramite $tramite)
    {
        $this->tramite = $tramite;
    }

    public function cambiarFlags():array
    {

        if($this->tramite->servicio->clave_ingreso == 'DC74'){

            return [
                'adiciona' => true,
                'solicitante' => true,
                'seccion' => true,
                'numero_oficio' => false,
                'nombre_solicitante' => false,
                'tomo' => false,
                'folio_real' => false,
                'registro' => false,
                'numero_propiedad' => false,
                'distrito' => true,
                'numero_inmuebles' => false,
                'numero_escritura' => false,
                'tomo_gravamen' => false,
                'foraneo' => false,
                'registro_gravamen' => false,
                'numero_paginas' => true,
                'valor_propiedad' => false,
                'dependencias' => false,
                'notarias' => false,
                'tipo_servicio' => true,
                'observaciones' => true
            ];

        }else{

            return [
                'adiciona' => true,
                'solicitante' => true,
                'seccion' => true,
                'numero_oficio' => false,
                'nombre_solicitante' => false,
                'tomo' => false,
                'folio_real' => false,
                'registro' => false,
                'numero_propiedad' => false,
                'distrito' => true,
                'numero_inmuebles' => false,
                'numero_escritura' => false,
                'tomo_gravamen' => false,
                'foraneo' => false,
                'registro_gravamen' => false,
                'numero_paginas' => false,
                'valor_propiedad' => false,
                'dependencias' => false,
                'notarias' => false,
                'tipo_servicio' => true,
                'observaciones' => true
            ];

        }

    }

    public function crearTramite():Tramite
    {

        $this->tramite->load('servicio');

        if($this->tramite->servicio->clave_ingreso != 'DC90' && $this->tramite->servicio->clave_ingreso != 'DC91' && $this->tramite->servicio->clave_ingreso != 'DC92' && $this->tramite->servicio->clave_ingreso != 'DC93'){

            if($this->tramite->adiciona == null){

                $consulta = $this->crearTramiteConsulta();

                $this->tramite->adiciona = $consulta->id;
                $this->tramite->limite_de_pago = $consulta->limite_de_pago;
                $this->tramite->orden_de_pago = $consulta->orden_de_pago;
                $this->tramite->linea_de_captura = $consulta->linea_de_captura;

                $tramite = (new TramiteService($this->tramite))->crear();

                $tramite->monto = $this->tramite->monto + $consulta->monto;

                $tramite->save();

                $this->tramite->load('servicio.categoria');

                (new SistemaRppService())->insertarSistemaRpp($this->tramite);

                return $this->tramite;

            }else{

                $tramite = (new TramiteService($this->tramite))->crear();



                (new SistemaRppService())->actualizarSistemaRpp($tramite);

                return $tramite;

            }

        }

        $tramite = (new TramiteService($this->tramite))->crear();

        (new SistemaRppService())->insertarSistemaRpp($tramite);

        return $tramite;

    }

    public function validaciones():array
    {

        if($this->tramite->servicio->clave_ingreso == 'DC74'){

            return [
                'modelo_editar.seccion' => 'required',
                'modelo_editar.distrito' => 'required',
                'modelo_editar.nombre_solicitante' => 'required',
                'modelo_editar.numero_paginas' => 'required',
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

            throw new ModelNotFoundException("Error al encontrar el servcio en App/Http/Services/Tramites/TramitesStrategies/Copias");

        }

        $consulta = Tramite::make();
        $consulta->id_servicio = $servicio->id;
        $consulta->estado = 'nuevo';
        $consulta->monto = $servicio->ordinario;
        $consulta->tipo_servicio = 'ordinario';
        $consulta->fecha_entrega = $this->tramite->fecha_entrega;
        $consulta->solicitante = $this->tramite->solicitante;
        $consulta->nombre_solicitante = $this->tramite->nombre_solicitante;
        $consulta->distrito = $this->tramite->distrito;
        $consulta->seccion = $this->tramite->seccion;

        return (new TramiteService($consulta))->crear();

    }

}

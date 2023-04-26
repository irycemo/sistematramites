<?php

namespace App\Http\Services\Tramites\TramitesStrategies;

use App\Models\Tramite;
use App\Models\Servicio;
use App\Http\Services\Tramites\TramiteService;
use App\Http\Services\SistemaRPP\SistemaRppService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Services\Tramites\TramitesStrategyInterface;

class Copias implements TramitesStrategyInterface{

    public function cambiarFlags():array
    {

        return  [
            'flag_seccion' => true,
            'flag_numero_oficio' => false,
            'flag_nombre_solicitante' => false,
            'flag_tomo' => true,
            'flag_folio_real' => true,
            'flag_registro' => true,
            'flag_numero_propiedad' => false,
            'flag_distrito' => true,
            'flag_numero_inmuebles' => false,
            'flag_numero_escritura' => false,
            'flag_numero_notaria' => false,
            'flag_tomo_gravamen' => false,
            'flag_foraneo' => false,
            'flag_registro_gravamen' => false,
            'flag_numero_paginas' => true,
            'flag_valor_propiedad' => false,
        ];

    }

    public function validaciones(){

        return [
            'modelo_editar.seccion' => 'required',
            'modelo_editar.tomo' => 'required_without:folio_real',
            'modelo_editar.registro' => 'required_without:folio_real',
            'modelo_editar.distrito' => 'required',
            'modelo_editar.numero_paginas' => 'required',
            'modelo_editar.nombre_solicitante' => 'required'
        ];

    }

    public function crearTramite(Tramite $tramite):Tramite
    {

        if($tramite->adiciona == null){

            $consulta = $this->crearTramiteConsulta($tramite);

            $tramite->adiciona = $consulta->id;
            $tramite->limite_de_pago = $consulta->limite_de_pago;
            $tramite->orden_de_pago = $consulta->orden_de_pago;
            $tramite->linea_de_captura = $consulta->linea_de_captura;

            $tramtie = (new TramiteService($tramite))->crear();

            $tramite->monto = $tramite->monto + $consulta->monto;

            $tramtie->save();

            $tramite->load('servicio.categoria');

            (new SistemaRppService())->insertarSistemaRpp($tramite);

            return $tramite;

        }else{

            $tramtie = (new TramiteService($tramite))->crear();

            (new SistemaRppService())->actualizarSistemaRpp($tramite);

            return $tramite;

        }



    }

    public function crearTramiteConsulta(Tramite $tramite):Tramite
    {

        $servicio = Servicio::where('nombre', 'Cuando se trate de uno o hasta cinco tomos o libros índice')->first();

        if(!$servicio){

            throw new ModelNotFoundException("Error al encontrar el servcio en App/Http/Services/Tramites/TramitesStrategies/Copias");

        }

        $consulta = Tramite::make();
        $consulta->id_servicio = $servicio->id;
        $consulta->estado = 'nuevo';
        $consulta->monto = $servicio->ordinario;
        $consulta->tipo_servicio = 'ordinario';
        $consulta->fecha_entrega = $tramite->fecha_entrega;
        $consulta->solicitante = $tramite->solicitante;
        $consulta->nombre_solicitante = $tramite->nombre_solicitante;
        $consulta->distrito = $tramite->distrito;
        $consulta->seccion = $tramite->seccion;

        return (new TramiteService($consulta))->crear();

    }

}

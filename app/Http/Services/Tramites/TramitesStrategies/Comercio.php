<?php

namespace App\Http\Services\Tramites\TramitesStrategies;

use App\Models\Tramite;
use App\Http\Services\Tramites\TramiteService;
use App\Http\Services\Tramites\TramitesStrategyInterface;

class Comercio implements TramitesStrategyInterface{

    public function cambiarFlags():array
    {

        return  [
            'flag_seccion' => true,
            'flag_numero_oficio' => false,
            'flag_nombre_solicitante' => false,
            'flag_tomo' => false,
            'flag_folio_real' => false,
            'flag_registro' => false,
            'flag_numero_propiedad' => false,
            'flag_distrito' => true,
            'flag_numero_inmuebles' => false,
            'flag_numero_escritura' => false,
            'flag_numero_notaria' => false,
            'flag_tomo_gravamen' => false,
            'flag_foraneo' => false,
            'flag_registro_gravamen' => false,
            'flag_numero_paginas' => false,
            'flag_valor_propiedad' => false,
            'flag_dependencias' => false,
            'flag_notarias' => false,
        ];

    }

    public function crearTramite(Tramite $tramite):Tramite
    {

        $tramite = (new TramiteService($tramite))->crear();

        return $tramite;

    }

    public function validaciones(){

        return [
            'modelo_editar.seccion' => 'required',
            'modelo_editar.distrito' => 'required',
            'modelo_editar.nombre_solicitante' => 'required',
        ];

    }

}

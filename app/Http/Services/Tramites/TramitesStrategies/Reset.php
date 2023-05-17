<?php

namespace App\Http\Services\Tramites\TramitesStrategies;

use App\Exceptions\TramiteNoRegistradoException;
use App\Models\Tramite;
use App\Http\Services\Tramites\TramitesStrategyInterface;

class Reset implements TramitesStrategyInterface{

    public function cambiarFlags(array $flags):array
    {

        return  [
            'adiciona' => false,
            'solicitante' => false,
            'seccion' => false,
            'numero_oficio' => false,
            'nombre_solicitante' => false,
            'tomo' => false,
            'folio_real' => false,
            'registro' => false,
            'numero_propiedad' => false,
            'distrito' => false,
            'numero_inmuebles' => false,
            'numero_escritura' => false,
            'tomo_gravamen' => false,
            'foraneo' => false,
            'registro_gravamen' => false,
            'numero_paginas' => false,
            'valor_propiedad' => false,
            'dependencias' => false,
            'notarias' => false,
            'tipo_servicio' => false,
            'observaciones' => false
        ];

    }

    public function crearTramite(Tramite $tramite):Tramite
    {

        throw new TramiteNoRegistradoException('El trámite no esta registrado en TramitesContexto. ' . 'Servicio id: ' . $tramite->id_servicio);

        return $tramite;

    }

    public function validaciones(){

        return [];

    }

}

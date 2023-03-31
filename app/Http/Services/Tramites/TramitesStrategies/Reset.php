<?php

namespace App\Http\Services\Tramites\TramitesStrategies;

use App\Exceptions\TramiteNoRegistradoException;
use App\Models\Tramite;
use App\Http\Services\Tramites\TramitesStrategyInterface;

class Reset implements TramitesStrategyInterface{

    public function cambiarFlags():array
    {

        return  [
            'flag_seccion' => false,
            'flag_numero_oficio' => false,
            'flag_nombre_solicitante' => false,
            'flag_tomo' => false,
            'flag_folio_real' => false,
            'flag_registro' => false,
            'flag_numero_propiedad' => false,
            'flag_distrito' => false,
            'flag_numero_inmuebles' => false,
            'flag_numero_escritura' => false,
            'flag_numero_notaria' => false,
            'flag_tomo_gravamen' => false,
            'flag_foraneo' => false,
            'flag_registro_gravamen' => false,
            'flag_numero_paginas' => false,
            'flag_valor_propiedad' => false,
        ];

    }

    public function crearTramite(Tramite $tramite):Tramite
    {

        throw new TramiteNoRegistradoException('El trámite no esta registrado en TramitesContexto. ' . 'Servicio id: ' . $tramite->id_servicio);

        return $tramite;

    }

}

<?php

namespace App\Http\Services\Tramites\TramitesStrategies;

use App\Http\Services\Tramites\TramitesStrategyInterface;

class Copias implements TramitesStrategyInterface{

    public function cambiarFlags():array
    {

        return  [
            'flag_seccion' => true,
            'flag_numero_oficio' => false,
            'flag_nombre_solicitante' => false,
            'flag_tomo' => true,
            'flag_folio_real' => false,
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

}

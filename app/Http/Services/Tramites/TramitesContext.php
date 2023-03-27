<?php

namespace App\Http\Services\Tramites;

use App\Http\Services\Tramites\TramitesStrategies\Reset;
use App\Http\Services\Tramites\TramitesStrategies\Copias;

class TramitesContext
{

    private TramitesStrategyInterface $strategy;

    public function __construct(string $tramite)
    {

        $this->strategy = match($tramite){

            'Copias certificadas' => new Copias(),
            'Copias simples' => new Copias(),
            default => new Reset()

        };

    }

    public function cambiarFlags():array
    {

        return $this->strategy->cambiarFlags();
    }

}

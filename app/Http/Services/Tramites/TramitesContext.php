<?php

namespace App\Http\Services\Tramites;

use App\Http\Services\Tramites\TramitesStrategies\Certificaciones;
use App\Models\Tramite;
use App\Http\Services\Tramites\TramitesStrategies\Reset;
use App\Http\Services\Tramites\TramitesStrategies\Copias;
use App\Http\Services\Tramites\TramitesStrategies\Comercio;
use App\Http\Services\Tramites\TramitesStrategies\Consultas;

class TramitesContext
{

    private TramitesStrategyInterface $strategy;

    public function __construct(string $categoria, Tramite $tramite)
    {

        $this->strategy = match($categoria){

            'Certificaciones' => new Certificaciones($tramite),
            'Comercio' => new Comercio($tramite),
            default => new Reset($tramite)

        };

    }

    public function cambiarFlags(array $flags):array
    {
        return $this->strategy->cambiarFlags($flags);
    }

    public function crearTramite():Tramite
    {
        return $this->strategy->crearTramite();
    }

    public function validaciones():array
    {
        return $this->strategy->validaciones();
    }

}

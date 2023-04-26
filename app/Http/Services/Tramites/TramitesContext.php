<?php

namespace App\Http\Services\Tramites;

use App\Models\Tramite;
use App\Http\Services\Tramites\TramitesStrategies\Reset;
use App\Http\Services\Tramites\TramitesStrategies\Copias;
use App\Http\Services\Tramites\TramitesStrategies\Comercio;
use App\Http\Services\Tramites\TramitesStrategies\Consultas;

class TramitesContext
{

    private TramitesStrategyInterface $strategy;

    public function __construct(string $tramite)
    {

        $this->strategy = match($tramite){

            'Copias certificadas (por página)' => new Copias(),
            'Copias simples (por página)' => new Copias(),
            'Búsqueda de antecedente de 1 a 10' => new Consultas(),
            'Búsqueda de bienes por índices de 11 a 20' => new Consultas(),
            'Búsqueda de bienes por índices de 21 o más' => new Consultas(),
            'Comercio' => new Comercio(),
            default => new Reset()

        };

    }

    public function cambiarFlags():array
    {
        return $this->strategy->cambiarFlags();
    }

    public function crearTramite(Tramite $tramite):Tramite
    {
        return $this->strategy->crearTramite($tramite);
    }

    public function validaciones():array
    {
        return $this->strategy->validaciones();
    }

}

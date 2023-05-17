<?php

namespace App\Http\Services\Tramites;

use App\Models\Tramite;

interface TramitesStrategyInterface
{

    public function cambiarFlags(array $flags);

    public function crearTramite();

    public function validaciones();

}

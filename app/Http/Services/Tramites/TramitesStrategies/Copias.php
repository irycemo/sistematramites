<?php

namespace App\Http\Services\Tramites\TramitesStrategies;

use App\Models\Tramite;
use App\Models\Servicio;
use Illuminate\Support\Facades\Log;
use App\Http\Services\Tramites\TramiteService;
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

    public function crearTramite(Tramite $tramite):Tramite
    {

        $consulta = $this->crearTramiteConsulta($tramite);

        $tramite->adiciona = $consulta->id;
        $tramite->limite_de_pago = $consulta->limite_de_pago;
        $tramite->orden_de_pago = $consulta->orden_de_pago;
        $tramite->linea_de_captura = $consulta->linea_de_captura;

        return (new TramiteService($tramite))->crear();

    }

    public function crearTramiteConsulta(Tramite $tramite):Tramite
    {

        $servicio = Servicio::where('nombre', 'Búsqueda de antecedente de 1 a 10')->firstOrFail();

        $consulta = Tramite::make();
        $consulta->id_servicio = $servicio->id;
        $consulta->estado = 'nuevo';
        $consulta->monto = $servicio->ordinario + $tramite->monto;
        $consulta->tipo_servicio = 'ordinario';
        $consulta->fecha_entrega = $tramite->fecha_entrega;
        $consulta->solicitante = $tramite->solicitante;
        $consulta->nombre_solicitante = $tramite->nombre_solicitante;

        return (new TramiteService($consulta))->crear();

    }

}

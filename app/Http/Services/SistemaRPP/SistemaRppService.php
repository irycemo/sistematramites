<?php

namespace App\Http\Services\SistemaRPP;

use App\Models\Tramite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Exceptions\ErrorAlEnviarTramiteSistemaRppException;
use App\Exceptions\ErrorAlActualizarMovimientoRegistralEnTramite;

class SistemaRppService{

    public function insertarSistemaRpp($tramite){

        $url = env('SISTEMA_RPP_SERVICE_INSERT');

        $response = Http::accept('application/json')->asForm()->post($url,[
            'monto' => $tramite->monto,
            'solicitante' => $tramite->solicitante,
            'nombre_solicitante' => $tramite->nombre_solicitante,
            'tramite' => $tramite->numero_control,
            'fecha_prelacion' => $tramite->fecha_prelacion,
            'tipo_servicio' => $tramite->tipo_servicio,
            'seccion' => $tramite->seccion,
            'distrito' => $tramite->distrito,
            'fecha_entrega' => $tramite->fecha_entrega->toDateString(),
            'fecha_pago' => $tramite->fecha_pago->toDateString(),
            'categoria_servicio' => $tramite->servicio->categoria->nombre,
            'servicio' => $tramite->servicio->clave_ingreso,
            'numero_oficio' => $tramite->numero_oficio,
            'folio_real' => $tramite->folio_real,
            'tomo' => $tramite->tomo,
            'tomo_bis' => $tramite->tomo_bis,
            'registro' => $tramite->registro,
            'registro_bis' => $tramite->registro_bis,
            'observaciones' => $tramite->observaciones,
            'numero_paginas' => $tramite->numero_paginas,
            'numero_inmuebles' => $tramite->numero_inmuebles,
            'numero_propiedad' => $tramite->numero_propiedad,
            'numero_escritura' => $tramite->numero_escritura,
            'numero_notaria' => $tramite->numero_notaria,
            'valor_propiedad' => $tramite->valor_propiedad,
        ]);

        $data = json_decode($response, true);

        if($response->status() == 200){

            $tramite = Tramite::find($tramite->id);

            if(!$tramite){

                throw new ErrorAlActualizarMovimientoRegistralEnTramite('Error al actualizar movimiento registral en tramite.' . $tramite->id);

            }

            $tramite->update(['movimiento_registral' => $data['data']['id']]);

            if($tramite->adicionaAlTramite)
                $tramite->adicionaAlTramite->update(['movimiento_registral' => $data['data']['id']]);

        }else{

            Log::error($response);

            throw new ErrorAlEnviarTramiteSistemaRppException("Error al enviar tramite pagado al sistema rpp.");

        }

    }

    public function actualizarSistemaRpp($tramite){

        $url = env('SISTEMA_RPP_SERVICE_UPDATE');

        $response = Http::accept('application/json')->asForm()->post($url,[
            'monto' => $tramite->monto,
            'solicitante' => $tramite->solicitante,
            'nombre_solicitante' => $tramite->nombre_solicitante,
            'tramite' => $tramite->numero_control,
            'fecha_prelacion' => now()->toDateString(), //Prelacion
            'tipo_servicio' => $tramite->tipo_servicio,
            'seccion' => $tramite->seccion,
            'observaciones' => $tramite->observaciones,
            'distrito' => $tramite->distrito,
            'fecha_entrega' => $tramite->fecha_entrega->toDateString(),
            'fecha_pago' => $tramite->fecha_pago?->toDateString(),
            'categoria_servicio' => $tramite->servicio->categoria->nombre,
            'servicio' => $tramite->servicio->clave_ingreso,
            'numero_oficio' => $tramite->numero_oficio,
            'folio_real' => $tramite->folio_real,
            'tomo' => $tramite->tomo,
            'tomo_bis' => $tramite->tomo_bis,
            'registro' => $tramite->registro,
            'registro_bis' => $tramite->registro_bis,
            'numero_paginas' => $tramite->numero_paginas,
            'numero_inmuebles' => $tramite->numero_inmuebles,
            'numero_propiedad' => $tramite->numero_propiedad,
            'numero_escritura' => $tramite->numero_escritura,
            'numero_notaria' => $tramite->numero_notaria,
            'valor_propiedad' => $tramite->valor_propiedad,
            'movimiento_registral' => $tramite->movimiento_registral,
        ]);

        if($response->status() != 200){

            Log::error($response);

            throw new ErrorAlEnviarTramiteSistemaRppException("Error al enviar tramite actualizado al sistema rpp.");

        }

    }

}

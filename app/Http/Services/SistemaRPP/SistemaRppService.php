<?php

namespace App\Http\Services\SistemaRpp;

use App\Exceptions\ErrorAlActualizarMovimientoRegistralEnTramite;
use App\Exceptions\ErrorAlEnviarTramiteSistemaRppException;
use App\Models\Tramite;
use Illuminate\Support\Facades\Http;

class SistemaRppService{

    public function insertarSistemaRpp($tramite){

        $url = 'http://127.0.0.1:8000/api/movimiento_registral';

        $response = Http::accept('application/json')->asForm()->post($url,[
            'monto' => $tramite->monto,
            'solicitante' => $tramite->nombre_solicitante,
            'tramite' => $tramite->numero_control,
            'fecha_prelacion' => now()->toDateString(), //Prelacion
            'tipo_servicio' => $tramite->tipo_servicio,
            'seccion' => $tramite->seccion,
            'distrito' => $tramite->distrito,
            'fecha_entrega' => now()->toDateString(), //fecha de entrega
            'categoria_servicio' => $tramite->servicio->categoria->nombre,
            'servicio' => $tramite->servicio->nombre,
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
        ]);

        $data = json_decode($response, true);

        if($response->status() == 200){

            $tramite = Tramite::find($tramite->id);

            if(!$tramite){

                throw new ErrorAlActualizarMovimientoRegistralEnTramite('Error al actualizar movimiento registral en tramite.' . $tramite->id);

            }

            $tramite->update(['movimiento_registral' => $data['data']['id']]);

        }else{

            throw new ErrorAlEnviarTramiteSistemaRppException("Error al enviar tramite pagado al sistema rpp."  . $response);

        }

    }

}

<?php

namespace App\Http\Services\SistemaRpp;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SistemaRppService{

    public function insertarSistemaRpp($tramite){

        $url = 'http://127.0.0.1:8000/api/movimiento_registral';

        try {

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

            if($data['result'] == 'error')
                Log::error("Error al enviar tramite pagado al sistema rpp. " . $response);

        } catch (\Throwable $th) {
             Log::error("Error al enviar tramite pagado al sistema rpp. " . $th->getMessage());
        }

    }

}

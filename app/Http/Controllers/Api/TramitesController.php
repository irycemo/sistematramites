<?php

namespace App\Http\Controllers\Api;

use App\Models\Tramite;
use App\Http\Controllers\Controller;
use App\Http\Requests\TramiteRequest;
use App\Http\Services\Tramites\TramiteService;

class TramitesController extends Controller
{

    public function finalizar(TramiteRequest $request){

        try {

            $tramite = Tramite::where('numero_control', $request->validated())->firstOrFail();

            if($tramite->clave_ingreso == 'DC93' || $tramite->clave_ingreso == 'DC90' || $tramite->clave_ingreso == 'DC91' || $tramite->clave_ingreso == 'DC92')
                (new TramiteService($tramite))->cambiarEstado('finalizado');
            else
                (new TramiteService($tramite))->cambiarEstado('concluido');

            return response()->json([
                'result' => 'success',
                'data' => $tramite
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'result' => 'error',
                'data' => $th->getMessage(),
            ], 500);

        }

    }

    public function rechazar(TramiteRequest $request){

        try {

            $tramite = Tramite::where('numero_control', $request->tramite)->firstOrFail();

            $tramite->update([
                        'estado' => 'rechazado',
                        'observaciones' => $request->observaciones
                    ]);

            if($tramite->adicionaAlTramite)
                $tramite->adicionaAlTramite->update(['estado' => 'rechazado']);

            return response()->json([
                'result' => 'success',
                'data' => $tramite
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'result' => 'error',
                'data' => $th->getMessage(),
            ], 500);

        }

    }

}

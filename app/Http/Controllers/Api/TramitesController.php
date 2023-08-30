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

            $tramite = Tramite::where('numero_control', $request->tramite)->firstOrFail();

            (new TramiteService($tramite))->cambiarEstado($request->estado);

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
                        'observaciones' => $tramite->observaciones . '<|>' .$request->observaciones
                    ]);

            (new TramiteService($tramite))->cambiarEstado('rechazado');

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

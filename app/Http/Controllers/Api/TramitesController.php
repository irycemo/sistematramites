<?php

namespace App\Http\Controllers\Api;

use App\Models\Tramite;
use App\Http\Controllers\Controller;
use App\Http\Requests\TramiteRequest;

class TramitesController extends Controller
{

    public function finalizar(TramiteRequest $request){

        try {

            $tramite = Tramite::where('numero_control', $request->validated())
                                ->update(['estado' => 'concluido']);

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

            $tramite = Tramite::where('numero_control', $request->id)
                                ->update([
                                    'estado' => 'rechazado',
                                    'observaciones' => $request->observaciones
                                ]);

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

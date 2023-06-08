<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SapControllerApi;
use App\Http\Controllers\Api\TramitesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('finalizar_tramite', [TramitesController::class, 'finalizar']);

Route::post('rechazar_tramite', [TramitesController::class, 'rechazar']);

Route::post('acredita_pago', SapControllerApi::class);

Route::fallback(function(){
    return response()->json([
            'result' => 'error',
            'data' => 'Página no encontrada.']
        , 404);
});

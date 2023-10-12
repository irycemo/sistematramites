<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tramite;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __invoke()
    {

        if(auth()->user()->hasRole('Administrador')){

            $tramtiesEstado = Tramite::selectRaw('estado, count(estado) count')
                                        ->whereMonth('created_at', Carbon::now()->month)
                                        ->groupBy('estado')
                                        ->get();

            $tramites = Tramite::selectRaw('year(created_at) year, monthname(created_at) month, count(*) data, sum(monto) sum')
                                    ->whereNotIn('estado', ['nuevo', 'expirado'])
                                    ->whereNotIn('id_servicio', [2,6])
                                    ->groupBy('year', 'month')
                                    ->orderBy('year', 'asc')
                                    ->get();

            $copias = Tramite::select('id', 'monto', 'adiciona', 'created_at')
                                ->with('adicionaAlTramite')
                                ->whereNotIn('estado', ['nuevo', 'expirado'])
                                ->whereIn('id_servicio', [2,6])
                                ->get()
                                ->map(function($tramite){

                                    if($tramite->adicionaAlTramite->id_servicio == 1){

                                        $tramite->monto = $tramite->monto - $tramite->adicionaAlTramite->monto;

                                        $tramite->año = Carbon::parse($tramite->created_at)->year;

                                        $tramite->month = Carbon::parse($tramite->created_at)->format('F');

                                    }

                                    return $tramite;

                                });

            foreach($tramites as $tramite){

                foreach($copias as $copia){

                    dd($copia);

                    if($tramite->year == '2023' && $tramite->month == $copia->month){

                        $tramite->sum += $copia->monto;

                    }

                }

            }

            $data = [];

            $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            foreach($tramites as $tramite){
                foreach($labels as $label){
                    $data[$tramite->year][$label] = 0;
                }
            }

            foreach($tramites as $tramite){

                foreach($labels as $label){

                    if($tramite->month === $label ){
                        if($data[$tramite->year][$label] == 0)
                            $data[$tramite->year][$label] = $tramite->sum;
                    }
                }

            }

            return view('dashboard', compact('data', 'tramtiesEstado'));

        }

        return view('dashboard');
    }
}

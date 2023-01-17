<?php

namespace App\Http\Controllers;

use App\Models\Tramite;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TramitesController extends Controller
{
    public function recibo(Tramite $tramite){

        $tramite->load('servicio');

        $pdf = Pdf::loadView('tramites.recibo', compact('tramite'));

        return $pdf->stream('recibo.pdf');
    }
}

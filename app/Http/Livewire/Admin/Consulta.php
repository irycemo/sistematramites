<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tramite;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;
use App\Http\Services\Tramites\TramiteService;
use App\Http\Services\LineasDeCaptura\LineaCaptura;
use Livewire\WithPagination;

class Consulta extends Component
{

    use ComponentesTrait;
    use WithPagination;

    public $search;
    public $tramite;
    public Tramite $modelo_editar;

    public function crearModeloVacio(){
        return Tramite::make();
    }

    public function abrirModalEditar(Tramite $modelo){

        $this->resetearTodo();

        $this->selected_id = $modelo->id;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

        $this->modal = true;

        $this->modelo_editar->load('adicionadoPor');

    }

    public function validarPago(){

        $array = (new LineaCaptura($this->modelo_editar))->validarLineaDeCaptura();

        if(!isset($array['SOAPBody']['n0MT_ValidarLinCaptura_ECC_Sender']['DOC_PAGO'])){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', 'No se encontro pago relacionado a la linea de captura.']);

        }else{

            try {

                (new TramiteService($this->modelo_editar))->procesarPago($array['SOAPBody']['n0MT_ValidarLinCaptura_ECC_Sender']['FEC_PAGO'], $array['SOAPBody']['n0MT_ValidarLinCaptura_ECC_Sender']['DOC_PAGO']);

                $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite se validó con éxito."]);

            } catch (\Throwable $th) {

                Log::error("Error al validar trámite por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
                $this->dispatchBrowserEvent('mostrarMensaje', ['error', $th->getMessage()]);
                $this->resetearTodo($borrado = true);

            }

        }

    }

    public function reimprimir(){

        $this->dispatchBrowserEvent('imprimir_recibo', ['tramite' => $this->modelo_editar->id]);

    }

    public function consultar(){

        $this->tramite = Tramite::where('numero_control', $this->search)->first();

    }

    public function render()
    {

        return view('livewire.admin.consulta')->extends('layouts.admin');
    }
}

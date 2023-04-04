<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tramite;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;

class Entrega extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public Tramite $modelo_editar;

    public $modalRecibir = false;
    public $modalFinalizar = false;

    public function crearModeloVacio(){
        return Tramite::make();
    }

    public function abrirModalRecibir(Tramite $modelo){
        $this->modalRecibir = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;
    }

    public function recibir(){

        $this->modelo_editar->recibido_por = auth()->user()->id;

        $this->modelo_editar->save();

        $this->resetearTodo();

    }

    public function abrirModalFinalizar(Tramite $modelo){
        $this->modalFinalizar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;
    }


    public function finalizar(){

        try{

            $this->modelo_editar->estado = 'finalizado';

            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite finalizó con éxito."]);

        }catch (\Throwable $th) {

            Log::error("Error al entregar trámite por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function mount(){

        array_push($this->fields, 'modalFinalizar', 'modalRecibir');

        $this->modelo_editar = $this->crearModeloVacio();

    }

    public function render()
    {

        $tramites = Tramite::with('creadoPor', 'actualizadoPor', 'adicionaAlTramite', 'servicio', 'files', 'recibidoPor')
                                ->where('estado', 'concluido')
                                ->where(function ($q){
                                    return $q->where('solicitante', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('nombre_solicitante', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('folio_real', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('tomo', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('registro', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('numero_propiedad', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('distrito', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('numero_control', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('numero_escritura', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere('numero_notaria', 'LIKE', '%' . $this->search . '%')
                                                ->orWhere(function($q){
                                                    return $q->whereHas('creadoPor', function($q){
                                                        return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                                    });
                                                })
                                                ->orWhere(function($q){
                                                    return $q->whereHas('servicio', function($q){
                                                        return $q->where('nombre', 'LIKE', '%' . $this->search . '%');
                                                    });
                                                });
                                })
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);

        return view('livewire.admin.entrega', compact('tramites'))->extends('layouts.admin');
    }
}

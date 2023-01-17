<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tramite;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\ComponentesTrait;

class Entrega extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $documento;
    public $documentos = [];

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'documento']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function finalizar(){

        try{

            $tramite = Tramite::find($this->selected_id);

            $tramite->update(['estado' => 'finalizado']);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite finalizó con éxito."]);

        }catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {

        $tramites = Tramite::with('creadoPor', 'actualizadoPor', 'adicionaAlTramite', 'servicio', 'files')
                                ->where('estado', 'finalizado')
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

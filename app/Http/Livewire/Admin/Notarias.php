<?php

namespace App\Http\Livewire\Admin;

use App\Models\Notaria;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;

class Notarias extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public Notaria $modelo_editar;

    protected function rules(){
        return [
            'modelo_editar.numero' => 'required|numeric|unique:notarias,numero,' . $this->modelo_editar->id,
            'modelo_editar.notario' => 'required',
            'modelo_editar.email' => 'required|email:rfc,dns|unique:notarias,email,' . $this->modelo_editar->id,
            'modelo_editar.rfc' => 'alpha_num|required|unique:notarias,rfc,' . $this->modelo_editar->id,
         ];
    }

    public function crearModeloVacio(){
        return Notaria::make();
    }

    public function abrirModalEditar(Notaria $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

    }

    public function crear(){

        $this->validate();

        try {

            $this->modelo_editar->creado_por = auth()->user()->id;
            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La notaria se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear notaria por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        try{

            $this->modelo_editar->actualizado_por = auth()->user()->id;
            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La notaria se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar notaria por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $notaria = Notaria::find($this->selected_id);

            $notaria->delete();

            $this->resetearTodo($borrado = true);

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La notaria se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar notaria por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {

        $notarias = Notaria::with('creadoPor', 'actualizadoPor')
                                ->where('numero', 'like', '%' . $this->search . '%')
                                ->orWhere('notario', 'like', '%' . $this->search . '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%')
                                ->orWhere('rfc', 'like', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);

        return view('livewire.admin.notarias', compact('notarias'))->extends('layouts.admin');
    }
}

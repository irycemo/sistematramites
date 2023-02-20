<?php

namespace App\Http\Livewire\Admin;

use App\Models\Uma;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;

class Umas extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $año;
    public $diario;

    protected function rules(){
        return [
            'año' => 'required|numeric|min:2016',
            'diario' => 'required|numeric'
         ];
    }

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'año', 'diario']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalEditar($modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $modelo['id'];
        $this->diario = $modelo['diario'];
        $this->año = $modelo['año'];

    }

    public function crear(){

        $this->validate();

        try {

            Uma::create([
                'diario' => $this->diario,
                'mensual' => $this->diario * 30.4,
                'anual' => $this->diario * 30.4 * 12,
                'año' => $this->año,
                'creado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La UMA se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear UMA por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        try{

            $uma = Uma::find($this->selected_id);

            $uma->update([
                'diario' => $this->diario,
                'mensual' => $this->diario * 30.4,
                'anual' => $this->diario * 30.4 * 12,
                'año' => $this->año,
                'actualizado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La UMA se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar UMA por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $uma = Uma::find($this->selected_id);

            $uma->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La UMA se elimino con exito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar UMA por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {

        $umas = Uma::with('creadoPor', 'actualizadoPor')
                            ->where('año', 'like', '%' . $this->search .'%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        return view('livewire.admin.umas', compact('umas'))->extends('layouts.admin');
    }

}

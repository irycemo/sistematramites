<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CategoriaServicio;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;

class CategoriasServicios extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $nombre;

    protected function rules(){
        return [
            'nombre' => 'required',
         ];
    }

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'nombre']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalEditar($modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $modelo['id'];
        $this->nombre = $modelo['nombre'];
    }

    public function crear(){

        $this->validate();

        try {

            CategoriaServicio::create([
                'nombre' => $this->nombre,
                'creado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La categoría se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear categoría por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        try{

            $categoria = CategoriaServicio::find($this->selected_id);

            $categoria->update([
                'nombre' => $this->nombre,
                'actualizado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La categoría se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar categoría por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $categoria = CategoriaServicio::find($this->selected_id);

            $categoria->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La categoría se elimino con exito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar categoría por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {

        $categorias = CategoriaServicio::with('creadoPor', 'actualizadoPor')
                                            ->where('nombre', 'LIKE', '%' . $this->search . '%')
                                            ->orderBy($this->sort, $this->direction)
                                            ->paginate($this->pagination);

        return view('livewire.admin.categorias-servicios', compact('categorias'))->extends('layouts.admin');
    }
}

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

    public CategoriaServicio $modelo_editar;

    protected function rules(){
        return [
            'modelo_editar.nombre' => 'required',
            'modelo_editar.concepto' => 'required',
            'modelo_editar.seccion' => 'required',
         ];
    }

    protected $validationAttributes  = [
        'modelo_editar.seccion' => 'sección',
    ];

    public function crearModeloVacio(){
        return CategoriaServicio::make();
    }

    public function abrirModalEditar(CategoriaServicio $modelo){

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

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La categoría se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear categoría por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        try{

            $this->modelo_editar->actualizado_por = auth()->user()->id;
            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La categoría se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar categoría por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $categoria = CategoriaServicio::find($this->selected_id);

            $categoria->delete();

            $this->resetearTodo($borrado = true);

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La categoría se elimino con exito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar categoría por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {

        $categorias = CategoriaServicio::with('creadoPor', 'actualizadoPor')
                                            ->where('nombre', 'LIKE', '%' . $this->search . '%')
                                            ->where('concepto', 'LIKE', '%' . $this->search . '%')
                                            ->orderBy($this->sort, $this->direction)
                                            ->paginate($this->pagination);

        return view('livewire.admin.categorias-servicios', compact('categorias'))->extends('layouts.admin');
    }
}

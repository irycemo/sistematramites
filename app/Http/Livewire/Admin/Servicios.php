<?php

namespace App\Http\Livewire\Admin;

use App\Models\Uma;
use Livewire\Component;
use App\Models\Servicio;
use Livewire\WithPagination;
use App\Models\CategoriaServicio;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;

class Servicios extends Component
{
    use WithPagination;
    use ComponentesTrait;

    public $nombre;
    public $tipo;
    public $umas;
    public $ordinario;
    public $urgente;
    public $estado;
    public $extra_urgente;
    public $categoria;
    public $operacion_parcial;
    public $operacion_principal;

    protected function rules(){
        return [
            'nombre' => 'required',
            'tipo' => 'required',
            'estado' => 'required',
            'umas' => 'numeric|nullable|min:0',
            'ordinario' => 'numeric|nullable',
            'urgente' => 'numeric|nullable|min:0',
            'extra_urgente' => 'numeric|nullable|min:0',
            'operacion_parcial' => 'required|numeric',
            'operacion_principal' => 'required|numeric',
            'categoria' => 'required'
         ];
    }

    protected $validationAttributes  = [
        'operacion_parcial' => 'operación parcial',
        'operacion_principal' => 'operación principal'
    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'selected_id', 'crear', 'estado', 'editar', 'modal', 'nombre', 'tipo', 'umas', 'ordinario', 'urgente','categoria', 'extra_urgente','operacion_principal','operacion_parcial']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalEditar($modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $modelo['id'];
        $this->nombre = $modelo['nombre'];
        $this->tipo = $modelo['tipo'];
        $this->umas = $modelo['umas'];
        $this->estado = $modelo['estado'];
        $this->ordinario = $modelo['ordinario'];
        $this->urgente = $modelo['urgente'];
        $this->extra_urgente = $modelo['extra_urgente'];
        $this->categoria = $modelo['categoria_servicio_id'];
        $this->operacion_principal = $modelo['operacion_principal'];
        $this->operacion_parcial = $modelo['operacion_parcial'];

    }

    public function checarTipo(){

        if($this->tipo == 'uma'){

            $uma = Uma::orderBy('año', 'desc')->first();

            $this->ordinario = $uma->diario * $this->umas;

            $this->urgente = $this->ordinario * 2;

            $this->extra_urgente = $this->ordinario * 3;

        }else{

            $this->urgente = $this->ordinario * 2;

            $this->extra_urgente = $this->ordinario * 3;
        }

    }

    public function crear(){

        $this->validate();

        $this->checarTipo();

        try {

            Servicio::create([
                'nombre' => $this->nombre,
                'tipo' => $this->tipo,
                'umas' => $this->umas,
                'estado' => $this->estado,
                'ordinario' => $this->ordinario,
                'urgente' => $this->urgente,
                'operacion_principal' => $this->operacion_principal,
                'operacion_parcial' => $this->operacion_parcial,
                'extra_urgente' => $this->extra_urgente,
                'categoria_servicio_id' => $this->categoria,
                'creado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El servicio se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear servicio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function actualizar(){

        $this->validate();

        $this->checarTipo();

        try{

            $servicio = Servicio::find($this->selected_id);

            $servicio->update([
                'nombre' => $this->nombre,
                'tipo' => $this->tipo,
                'umas' => $this->umas,
                'estado' => $this->estado,
                'ordinario' => $this->ordinario,
                'urgente' => $this->urgente,
                'operacion_principal' => $this->operacion_principal,
                'operacion_parcial' => $this->operacion_parcial,
                'extra_urgente' => $this->extra_urgente,
                'categoria_servicio_id' => $this->categoria,
                'actualizado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El servicio se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar servicio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $servicio = Servicio::find($this->selected_id);

            $servicio->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El servicio se elimino con exito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar servicio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {

        $categorias = CategoriaServicio::all();

        $servicios = Servicio::with('categoria', 'creadoPor', 'actualizadoPor')
                                ->where('nombre', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('tipo', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('umas', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('estado', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('ordinario', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('operacion_principal', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('operacion_parcial', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('urgente', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('extra_urgente', 'LIKE', '%' . $this->search . '%')
                                ->orWhere(function($q){
                                    return $q->whereHas('categoria', function($q){
                                        return $q->where('nombre', 'LIKE', '%' . $this->search . '%');
                                    });
                                })
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);


        return view('livewire.admin.servicios', compact('categorias', 'servicios'))->extends('layouts.admin');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use App\Http\Traits\ComponentesTrait;

class Usuarios extends Component
{
    use WithPagination;
    use ComponentesTrait;

    public $nombre;
    public $email;
    public $status;
    public $role;
    public $localidad;
    public $area;

    protected function rules(){
        return [
            'nombre' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $this->selected_id,
            'status' => 'required|in:activo,inactivo',
            'role' => 'required',
            'localidad' => 'required',
            'area' => 'required'
         ];
    }

    protected $validationAttributes  = [
        'role' => 'rol',
    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'nombre', 'email', 'status','role', 'localidad', 'area']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalEditar($usuario){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $usuario['id'];
        $this->nombre = $usuario['name'];
        $this->email = $usuario['email'];
        $this->status = $usuario['status'];
        $this->area = $usuario['area'];
        $this->localidad = $usuario['localidad'];
        $this->role = 1;

    }

    public function crear(){

        $this->validate();

        $user = User::where('name', $this->nombre)->first();

        if($user){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "El usuario " . $this->nombre . " ya esta registrado."]);

            $this->resetearTodo();

            return;

        }

        try {

            $usuario = User::create([
                'name' => $this->nombre,
                'email' => $this->email,
                'status' => $this->status,
                'area' => $this->area,
                'localidad' => $this->localidad,
                'password' => 'sistema',
                'creado_por' => auth()->user()->id
            ]);

            $usuario->roles()->attach($this->role);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El usuario se creó con éxito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function actualizar(){

        $this->validate();

        try{

            $usuario = User::find($this->selected_id);

            $usuario->update([
                'name' => $this->nombre,
                'email' => $this->email,
                'area' => $this->area,
                'status' => $this->status,
                'localidad' => $this->localidad,
                'actualizado_por' => auth()->user()->id
            ]);

            $usuario->roles()->sync($this->role);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El usuario se actualizó con éxito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function borrar(){

        try{

            $usuario = User::find($this->selected_id);

            $usuario->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El usuario se eliminó con éxito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function render()
    {

        $usuarios = User::with('creadoPor', 'actualizadoPor')->where('name', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('localidad', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('area', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('status', 'LIKE', '%' . $this->search . '%')
                            ->orWhere(function($q){
                                return $q->whereHas('roles', function($q){
                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        $roles = Role::all();

        return view('livewire.admin.usuarios', compact('usuarios', 'roles'))->extends('layouts.admin');
    }
}

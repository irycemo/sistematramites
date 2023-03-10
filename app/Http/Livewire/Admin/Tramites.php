<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tramite;
use Livewire\Component;
use App\Http\Constantes;
use App\Models\Servicio;
use Livewire\WithPagination;
use App\Models\CategoriaServicio;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;
use App\Http\Services\Tramites\TramiteService;
use App\Http\Services\Tramites\TramitesContext;

class Tramites extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $solicitantes;
    public $secciones;
    public $categorias;
    public $categoria_servicio;
    public $servicios;
    public $adicionaTramite;

    public Tramite $modelo_editar;

    public $flags = [
        'flag_seccion' => false,
        'flag_numero_oficio' => false,
        'flag_nombre_solicitante' => false,
        'flag_tomo' => false,
        'flag_folio_real' => false,
        'flag_registro' => false,
        'flag_numero_propiedad' => false,
        'flag_distrito' => false,
        'flag_numero_inmuebles' => false,
        'flag_numero_escritura' => false,
        'flag_numero_notaria' => false,
        'flag_tomo_gravamen' => false,
        'flag_foraneo' => false,
        'flag_registro_gravamen' => false,
        'flag_numero_paginas' => false,
        'flag_valor_propiedad' => false,
    ];

    protected function rules(){
        return [
            'modelo_editar.id_servicio' => 'required',
            'modelo_editar.solicitante' => 'required',
            'modelo_editar.nombre_solicitante' => 'required_if:modelo_editar.solicitante,Ventanilla,Juzgado',
            'modelo_editar.numero_oficio' => 'nullable',
            'modelo_editar.folio_real' => 'nullable',
            'modelo_editar.tomo' => 'nullable|required_with:tomo_bis',
            'modelo_editar.tomo_bis' => 'nullable',
            'modelo_editar.registro' => 'nullable|required_with:registro_bis',
            'modelo_editar.registro_bis' => 'nullable',
            'modelo_editar.tomo_gravamen' => 'nullable',
            'modelo_editar.registro_gravamen' => 'nullable',
            'modelo_editar.distrito' => 'nullable',
            'modelo_editar.seccion' => 'nullable',
            'modelo_editar.limite_de_pago' => 'nullable',
            'modelo_editar.dias_de_entrega' => 'nullable',
            'modelo_editar.monto' => 'nullable',
            'modelo_editar.tipo_servicio' => 'required',
            'modelo_editar.numero_paginas' => 'nullable',
            'modelo_editar.numero_inmuebles' => 'nullable',
            'modelo_editar.numero_propiedad' => 'nullable',
            'modelo_editar.numero_escritura' => 'nullable',
            'modelo_editar.numero_notaria' => 'nullable',
            'modelo_editar.valor_propiedad' => 'nullable',
            'modelo_editar.foraneo' => 'nullable|boolean',
            'modelo_editar.adiciona' => 'required_if:adicionaTramite,true'
         ];
    }

    protected $messages = [
        'modelo_editar.adiciona.required_if' => 'El campo trámite es obligatorio cuando el campo adiciona tramite está seleccionado.',
    ];

    protected $validationAttributes  = [
        'modelo_editar.id_servicio' => 'servicio',
        'modelo_editar.folio_real' => 'folio real',
        'modelo_editar.tomo_bis' => 'tomo bis',
        'modelo_editar.registro_bis' => 'registro bis',
        'modelo_editar.numero_propiedad' => 'número de propiedad',
        'modelo_editar.nombre_solicitante' => 'nombre del solicitante',
        'modelo_editar.dias_de_entrega' => 'días de entrega',
        'modelo_editar.tipo_servicio' => 'tipo de servicio',
        'modelo_editar.numero_control' => 'número de control',
        'modelo_editar.numero_escritura' => 'número de escritura',
        'modelo_editar.numero_notaria' => 'número de notaria',
        'modelo_editar.limite_de_pago' => 'límite de pago',
        'modelo_editar.adiciona' => 'trámite',
        'modelo_editar.numero_inmuebles' => 'cantidad de inmuebles',
        'modelo_editar.numero_paginas' => 'número de páginas',
        'modelo_editar.valor_propiedad' => 'valor de la propiedad',
        'modelo_editar.registro_gravamen' => 'registro gravamen',
        'modelo_editar.tomo_gravamen' => 'tomo gravamen',
        'modelo_editar.numero_oficio' => 'número de oficio'
    ];

    public function crearModeloVacio(){
        return Tramite::make();
    }

    public function updatedAdicionaTramite(){

        $this->modelo_editar->adiciona = null;

        if($this->adicionaTramite)
            $this->dispatchBrowserEvent('select2');
        else
            $this->modelo_editar->adiciona = null;

    }

    public function updatedCategoriaServicio(){

        /* Buscar servicios de la categoría */
        $this->servicios = Servicio::where('estado', 'activo')->where('categoria_servicio_id', $this->categoria_servicio)->get();

        /* Al cambiar de categoría resetear inputs */
        $this->reset(['flags']);

        $this->modelo_editar = $this->crearModeloVacio();

    }

    public function updatedModeloEditarIdServicio(){

        $servicio = Servicio::find($this->modelo_editar->id_servicio);

        $this->reset(['flags']);

        $this->modelo_editar = $this->crearModeloVacio();

        $this->modelo_editar->id_servicio = $servicio->id;

        $tramiteContext = new TramitesContext($servicio->nombre);

        $this->flags = $tramiteContext->cambiarFlags();

    }

    public function updatedModeloEditarSolicitante(){

        if($this->modelo_editar->solicitante == 'Ventanilla'){

            $this->flags['flag_nombre_solicitante'] = true;
            $this->modelo_editar->nombre_solicitante = null;

        }elseif($this->modelo_editar->solicitante == 'Oficialia de partes'){

            $this->flags['flag_nombre_solicitante'] = true;
            $this->modelo_editar->nombre_solicitante = null;

        }else{
            $this->flags['flag_nombre_solicitante'] = false;
            $this->modelo_editar->nombre_solicitante = null;
        }

        if($this->modelo_editar->solicitante == "Pensiones"){

            $this->modelo_editar->tipo_servicio = "Extra Urgente";
            $this->updatedModeloEditarTipoServicio();

        }
    }

    public function updatedModeloEditarTipoServicio(){

        if($this->modelo_editar->id_servicio == ""){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Debe seleccionar un servicio."]);

            $this->modelo_editar->tipo_servicio = null;

            $this->modelo_editar->solicitante = null;

            return;
        }

        if($this->modelo_editar->tipo_servicio == 'Ordinario'){

            $this->modelo_editar->dias_de_entrega = 4;
            $this->modelo_editar->monto = Servicio::find($this->modelo_editar->id_servicio)->ordinario;

        }
        elseif($this->modelo_editar->tipo_servicio == 'Urgente'){

            $this->modelo_editar->dias_de_entrega = 1;
            $this->modelo_editar->monto = Servicio::find($this->modelo_editar->id_servicio)->urgente;

            if($this->modelo_editar->monto == 0){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No hay servicio urgente para el servicio seleccionado."]);

                $this->modelo_editar->tipo_servicio = null;
            }

        }
        elseif($this->modelo_editar->tipo_servicio == 'Extra Urgente'){

            $this->modelo_editar->dias_de_entrega = 0;
            $this->modelo_editar->monto = Servicio::find($this->modelo_editar->id_servicio)->extra_urgente;

            if($this->modelo_editar->monto == 0){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No hay servicio extra urgente para el servicio seleccionado."]);

                $this->modelo_editar->tipo_servicio = null;
            }

        }

    }

    public function updatedModeloEditarForaneo(){

        $this->updatedModeloEditarTipoServicio();

    }

    public function abrirModalEditar(Tramite $modelo){

        $this->resetearTodo();

        $this->selected_id = $modelo->id;
        $servicio = Servicio::find($modelo->id_servicio);
        $this->categoria_servicio = $servicio->categoria_servicio_id;
        $this->updatedCategoriaServicio();

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

        $this->modal = true;
        $this->editar = true;

        foreach($this->modelo_editar->getAttributes() as $attribute => $value){

            if($value)
                $this->flags['flag_' . $attribute] = true;

        }

        if($this->modelo_editar->adiciona)
            $this->adicionaTramite = true;

    }

    public function crear(){

        $this->validate();

        try {

            $tramite = (new TramiteService($this->modelo_editar))->crear();

            $this->resetearTodo();

            $this->selected_id = $tramite->id;

            $this->dispatchBrowserEvent('imprimir_recibo', ['tramite' => $this->selected_id]);

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear trámite por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }
    }

    public function actualizar(){

        $this->validate();

        try{

            (new TramiteService($this->modelo_editar))->actualizar();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar trámite por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            (new TramiteService($this->modelo_editar))->borrar($this->selected_id);

            $this->resetearTodo($borrado = true);

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar trámite por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }
    }

    public function mount(){

        array_push($this->fields, 'adicionaTramite', 'flags', 'servicios', 'categoria_servicio');

        $this->modelo_editar = $this->crearModeloVacio();

        $this->categorias = CategoriaServicio::all();

        $this->solicitantes = Constantes::SOLICITANTES;

        $this->secciones = Constantes::SECCIONES;

    }

    public function render()
    {

        $tramites = Tramite::with('creadoPor', 'actualizadoPor', 'adicionaAlTramite', 'servicio')
                                ->where('solicitante', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('nombre_solicitante', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('folio_real', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('tomo', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('estado', 'LIKE', '%' . $this->search . '%')
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
                                })
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);

        return view('livewire.admin.tramites', compact('tramites'))->extends('layouts.admin');
    }
}

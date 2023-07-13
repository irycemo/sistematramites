<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Notaria;
use App\Models\Tramite;
use Livewire\Component;
use App\Http\Constantes;
use App\Models\Servicio;
use App\Models\Dependencia;
use Livewire\WithPagination;
use App\Models\CategoriaServicio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;
use App\Http\Services\Tramites\TramiteService;
use App\Http\Services\Tramites\TramitesContext;
use App\Http\Services\LineasDeCaptura\LineaCaptura;
use App\Http\Services\SistemaRPP\SistemaRppService;

class Entrada extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $solicitantes;
    public $secciones;
    public $categorias;
    public $categoria;
    public $categoria_selected;
    public $servicios;
    public $servicio;
    public $servicio_selected;
    public $adicionaTramite;
    public $tramitesAdiciona;
    public $distritos;
    public $dependencias;
    public $notarias;
    public $notaria;
    public $numero_de_control;
    public $tramite;

    public Tramite $modelo_editar;

    public $flags = [
        'adiciona' => false,
        'solicitante' => false,
        'nombre_solicitante' => false,
        'seccion' => false,
        'numero_oficio' => false,
        'tomo' => false,
        'folio_real' => false,
        'registro' => false,
        'numero_propiedad' => false,
        'distrito' => false,
        'numero_inmuebles' => false,
        'numero_escritura' => false,
        'tomo_gravamen' => false,
        'foraneo' => false,
        'registro_gravamen' => false,
        'numero_paginas' => false,
        'valor_propiedad' => false,
        'dependencias' => false,
        'notarias' => false,
        'tipo_servicio' => false,
        'observaciones' => false
    ];

    protected function rules(){
        return [
            'servicio' => 'required',
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
            'modelo_editar.fecha_entrega' => 'nullable',
            'modelo_editar.monto' => 'nullable',
            'modelo_editar.tipo_servicio' => 'required',
            'modelo_editar.numero_paginas' => 'nullable',
            'modelo_editar.numero_inmuebles' => 'nullable',
            'modelo_editar.numero_propiedad' => 'nullable',
            'modelo_editar.numero_escritura' => 'nullable',
            'modelo_editar.numero_notaria' => 'nullable',
            'modelo_editar.nombre_notario' => 'nullable',
            'modelo_editar.valor_propiedad' => 'nullable',
            'modelo_editar.observaciones' => 'nullable',
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
        'modelo_editar.fecha_entrega' => 'fecha de entrega',
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
        'modelo_editar.numero_oficio' => 'número de oficio',
    ];

    public function crearModeloVacio(){
        return Tramite::make([
            'numero_paginas' => 1
        ]);
    }

    public function updatedCategoriaSelected(){

        if($this->categoria_selected == ""){

            $this->resetearTodo($borrado = true);

            return;

        }

        $this->categoria = json_decode($this->categoria_selected, true);

        $this->servicios = Servicio::where('categoria_servicio_id', $this->categoria['id'])->get();

        $this->resetearTodo($borrado = true);

    }

    public function updatedServicioSelected(){

        if($this->servicio_selected == ""){

            $this->resetearTodo($borrado = true);

            return;

        }

        $this->resetearTodo($borrado = true);

        $this->servicio = json_decode($this->servicio_selected, true);

        $this->modelo_editar->id_servicio = $this->servicio['id'];

        $context = new TramitesContext($this->categoria['nombre'], $this->modelo_editar);

        $this->flags = $context->cambiarFlags($this->flags);

        $this->updatedModeloEditarTipoServicio();

    }

    public function updatedModeloEditarTipoServicio(){

        if($this->modelo_editar->id_servicio == ""){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Debe seleccionar un servicio."]);

            $this->modelo_editar->tipo_servicio = null;

            $this->modelo_editar->solicitante = null;

            return;
        }

        if($this->modelo_editar->tipo_servicio == 'ordinario'){

            $this->modelo_editar->monto = $this->servicio['ordinario'] * $this->modelo_editar->numero_paginas;

            if($this->modelo_editar->monto == 0){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No hay servicio ordinario para el servicio seleccionado."]);

                $this->modelo_editar->tipo_servicio = null;
            }

        }
        elseif($this->modelo_editar->tipo_servicio == 'urgente'){

            $this->modelo_editar->monto = $this->servicio['urgente'] * $this->modelo_editar->numero_paginas;

            if(now() < now()->startOfDay()->addHour(12)){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No se pueden hacer trámites urgentes despues de las 11:00 hrs."]);

                $this->modelo_editar->tipo_servicio = null;
            }

            if($this->modelo_editar->monto == 0){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No hay servicio urgente para el servicio seleccionado."]);

                $this->modelo_editar->tipo_servicio = null;
            }

        }
        elseif($this->modelo_editar->tipo_servicio == 'extra_urgente'){

            $this->modelo_editar->monto = $this->servicio['extra_urgente'] * $this->modelo_editar->numero_paginas;

            if(now() < now()->startOfDay()->addHour(14)){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No se pueden hacer trámites extra urgentes despues de las 13:00 hrs."]);

                $this->modelo_editar->tipo_servicio = null;
            }

            if($this->modelo_editar->monto == 0){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No hay servicio extra urgente para el servicio seleccionado."]);

                $this->modelo_editar->tipo_servicio = null;
            }

        }

        if($this->modelo_editar->solicitante == 'Oficialia de partes'){

            $this->modelo_editar->monto = 0;

        }

    }

    public function updatedModeloEditarSolicitante(){

        $this->modelo_editar->nombre_solicitante = null;
        $this->modelo_editar->nombre_notario = null;
        $this->modelo_editar->numero_notaria = null;
        $this->notaria = null;

        if($this->modelo_editar->solicitante == 'Usuario'){

            $this->flags['nombre_solicitante'] = true;
            $this->flags['dependencias'] = false;
            $this->flags['notarias'] = false;


        }elseif($this->modelo_editar->solicitante == 'Notaría'){

            $this->flags['dependencias'] = false;
            $this->flags['nombre_solicitante'] = false;
            $this->flags['notarias'] = true;

        }elseif($this->modelo_editar->solicitante == 'Oficialia de partes'){

            if(!auth()->user()->hasRole('Oficialia de partes')){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No tienes permisos para esta opción."]);

                $this->modelo_editar->solicitante = null;

                return;

            }

            $this->flags['nombre_solicitante'] = false;
            $this->flags['dependencias'] = true;
            $this->flags['notarias'] = false;
            $this->flags['numero_oficio'] = true;

            $this->modelo_editar->monto = 0;

        }else{

            $this->flags['nombre_solicitante'] = false;
            $this->flags['dependencias'] = false;
            $this->flags['notarias'] = false;
            $this->modelo_editar->nombre_solicitante = $this->modelo_editar->solicitante;
        }

        if($this->modelo_editar->solicitante == "S.T.A.S.P.E."){

            $this->modelo_editar->nombre_solicitante = $this->modelo_editar->solicitante;
            $this->modelo_editar->tipo_servicio = "extra_urgente";

        }

        $this->updatedModeloEditarTipoServicio();

    }

    public function updatedModeloEditarIdServicio(){

        $this->resetearTodo($borrado = true);

        $this->modelo_editar->id_servicio = $this->servicio['id'];

        $tramiteContext = new TramitesContext($this->categoria['nombre'], $this->modelo_editar);

        $this->flags = $tramiteContext->cambiarFlags($this->flags);

    }

    public function updatedModeloEditarNumeroPaginas(){

        $this->updatedModeloEditarTipoServicio();

    }

    public function updatedNotaria(){

        if($this->notaria == ""){

            $this->reset(['notaria']);

            $this->modelo_editar->numero_notaria = null;
            $this->modelo_editar->nombre_notario = null;
            $this->modelo_editar->nombre_solicitante = null;

            return;

        }

        $notaria = json_decode($this->notaria);

        $this->modelo_editar->numero_notaria = $notaria->numero;
        $this->modelo_editar->nombre_notario = $notaria->notario;
        $this->modelo_editar->nombre_solicitante = $notaria->numero . ' ' .$notaria->notario;

    }

    public function updatedAdicionaTramite(){

        $this->modelo_editar->adiciona = null;

        if(!$this->adicionaTramite)
            $this->modelo_editar->adiciona = null;
        else{

            $this->dispatchBrowserEvent('select2');

            /* Copias certificadas y simples */
            if($this->servicio['clave_ingreso'] == 'DL14' || $this->servicio['clave_ingreso'] == 'DL13'){

                $this->tramitesAdiciona = Tramite::whereIn('estado', ['pagado', 'rechazado'])
                                                ->whereIn('id_servicio', [1, $this->servicio['id']])
                                                ->get();

            }else

                $this->tramitesAdiciona = Tramite::whereIn('estado', ['pagado', 'rechazado'])
                                                    ->where('id_servicio', $this->servicio['id'])
                                                    ->get();

        }

    }

    public function updatedModeloEditarAdiciona(){

        $tramite = Tramite::find($this->modelo_editar->adiciona);

        if($tramite->servicio->clave_ingreso == 'DL13' || $tramite->servicio->clave_ingreso == 'DL14'){

            $this->flags['solicitante'] = false;
            $this->flags['tomo'] = false;
            $this->flags['registro'] = false;
            $this->flags['distrito'] = false;
            $this->flags['seccion'] = false;

            $this->modelo_editar->solicitante = $tramite->solicitante;
            $this->modelo_editar->tomo = $tramite->tomo;
            $this->modelo_editar->registro = $tramite->registro;
            $this->modelo_editar->distrito = $tramite->distrito;
            $this->modelo_editar->seccion = $tramite->seccion;

        }

        if($tramite->tipo_servicio != $this->modelo_editar->tipo_servicio){



        }

    }

    public function buscarTramite(){

        $this->resetearTodo($borrado = true);

        $this->categoria = null;

        $this->tramite = Tramite::with('servicio')->whereIn('estado', ['nuevo', 'rechazado'])->where('numero_control', $this->numero_de_control)->first();

        if(!$this->tramite)
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No se encontro el trámite."]);

        $this->numero_de_control = null;

    }

    public function reimprimir(){

        $this->dispatchBrowserEvent('imprimir_recibo', ['tramite' => $this->tramite->id]);

    }

    public function editar(){

        if($this->modelo_editar->isNot($this->tramite))
            $this->modelo_editar = $this->tramite;

        $this->reset(['tramite']);

        $this->categoria = $this->modelo_editar->servicio->categoria;

        $this->categoria_selected = json_encode($this->categoria);

        $this->servicio = $this->modelo_editar->servicio;

        $this->servicios = Servicio::where('categoria_servicio_id', $this->categoria['id'])->get();

        $this->servicio_selected = json_encode($this->servicio);

        $context = new TramitesContext($this->categoria['nombre'], $this->modelo_editar);

        $this->flags = $context->cambiarFlags($this->flags);

        $this->flags['numero_paginas'] = false;

        $this->flags['adiciona'] = false;

        $this->flags['tipo_servicio'] = false;

        $this->editar = true;

    }

    public function validarPago(){

        $array = (new LineaCaptura($this->tramite))->validarLineaDeCaptura();

        if(!isset($array['SOAPBody']['n0MT_ValidarLinCaptura_ECC_Sender']['DOC_PAGO'])){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', 'No se encontro pago relacionado a la linea de captura.']);

        }else{

            try {

                (new TramiteService($this->tramite))->procesarPago($array['SOAPBody']['n0MT_ValidarLinCaptura_ECC_Sender']['FEC_PAGO'], $array['SOAPBody']['n0MT_ValidarLinCaptura_ECC_Sender']['DOC_PAGO']);

                $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite se validó con éxito."]);

            } catch (\Throwable $th) {

                Log::error("Error al validar trámite por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
                $this->dispatchBrowserEvent('mostrarMensaje', ['error', $th->getMessage()]);
                $this->resetearTodo($borrado = true);

            }

        }

    }

    public function crear(){

        $this->validate([
            'servicio' => 'required',
            'categoria' => 'required'
        ]);


        $context = new TramitesContext($this->categoria['nombre'], $this->modelo_editar);

        $this->validate(array_merge($this->rules(), $context->validaciones()));

        try {

            DB::transaction(function () use($context){

                $tramite = $context->crearTramite();

                if($this->modelo_editar->solicitante == 'Oficialia de partes'){

                    (new SistemaRppService())->insertarSistemaRpp($this->modelo_editar);

                }

                $this->resetearTodo($borrado = true);

                $this->selected_id = $tramite->id;

                $this->dispatchBrowserEvent('imprimir_recibo', ['tramite' => $this->selected_id]);

                $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite se creó con éxito."]);

        });

        } catch (\Throwable $th) {

            Log::error("Error al crear trámite por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', $th->getMessage()]);
            $this->resetearTodo($borrado = true);

        }
    }

    public function actualizar(){

        $this->validate();

        try{

            (new TramiteService($this->modelo_editar))->actualizar();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar trámite por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', $th->getMessage()]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            (new TramiteService($this->modelo_editar))->borrar($this->selected_id);

            $this->resetearTodo($borrado = true);

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar trámite por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', $th->getMessage()]);
            $this->resetearTodo();

        }
    }

    public function mount(){

        array_push($this->fields, 'adicionaTramite', 'flags','tramite', 'flags', 'editar');

        $this->modelo_editar = $this->crearModeloVacio();

        $this->categorias = CategoriaServicio::all();

        $this->solicitantes = Constantes::SOLICITANTES;

        $this->secciones = Constantes::SECCIONES;

        if(auth()->user()->ubicacion == 'Regional 4'){

            $this->distritos = [2 => '02 Uruapan',];

        }else{

            $this->distritos = Constantes::DISTRITOS;

            unset($this->distritos[2]);

        }

        $this->dependencias = Dependencia::orderBy('nombre')->get();

        $this->notarias = Notaria::orderBy('numero')->get();

    }

    public function render()
    {

        $tramites = Tramite::with('creadoPor', 'actualizadoPor', 'adicionaAlTramite', 'servicio')
                                ->where('estado', 'nuevo')
                                ->where(function($q){
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


        return view('livewire.admin.entrada', compact('tramites'))->extends('layouts.admin');
    }
}

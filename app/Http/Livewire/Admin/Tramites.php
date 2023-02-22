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

class Tramites extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $solicitantes;
    public $secciones;
    public $categorias;

    public $id_servicio;
    public $estado;
    public $categoria_servicio;
    public $servicios;
    public $solicitante;
    public $nombre_solicitante; public $flag_nombre_solicitante = false;
    public $numero_oficio; public $flag_numero_oficio = false;
    public $tomo; public $flag_tomo = false;
    public $folio_real; public $flag_folio_real = false;
    public $tomo_bis;
    public $registro; public $flag_registro = false;
    public $registro_bis;
    public $numero_propiedad; public $flag_numero_propiedad = false;
    public $distrito; public $flag_distrito = false;
    public $dias_de_entrega;
    public $monto;
    public $tipo_servicio;
    public $numero_inmuebles; public $flag_numero_inmuebles = false;
    public $numero_control;
    public $numero_escritura; public $flag_numero_escritura = false;
    public $numero_notaria; public $flag_numero_notaria = false;
    public $limite_de_pago;
    public $adiciona; public $adicionaTramite;
    public $foraneo; public $flag_foraneo = false;
    public $seccion; public $flag_seccion = false;
    public $tomo_gravamen; public $flag_tomo_gravamen = false;
    public $registro_gravamen; public $flag_registro_gravamen = false;
    public $valor_propiedad; public $flag_valor_propiedad = false;
    public $numero_paginas; public $flag_numero_paginas = false;

    protected function rules(){
        return [
            'id_servicio' => 'required',
            'solicitante' => 'required',
            'tomo' => 'nullable|required_with:tomo_bis',
            'tomo_bis' => 'nullable',
            'registro' => 'nullable|required_with:registro_bis',
            'registro_bis' => 'nullable',
            'tipo_servicio' => 'required',
            'nombre_solicitante' => 'required_if:solicitante,Ventanilla,Juzgado',
            'adiciona' => 'required_if:adicionaTramite,true'
         ];
    }

    protected $messages = [
        'adiciona.required_if' => 'El campo trámite es obligatorio cuando el campo adiciona tramite está seleccionado.',
    ];

    protected $validationAttributes  = [
        'id_servicio' => 'servicio',
        'folio_real' => 'folio real',
        'tomo_bis' => 'tomo bis',
        'registro_bis' => 'registro bis',
        'numero_propiedad' => 'número de propiedad',
        'nombre_solicitante' => 'nombre del solicitante',
        'dias_de_entrega' => 'días de entrega',
        'tipo_servicio' => 'tipo de servicio',
        'numero_control' => 'número de control',
        'numero_escritura' => 'número de escritura',
        'numero_notaria' => 'número de notaria',
        'limite_de_pago' => 'límite de pago',
        'adiciona' => 'trámite',
        'numero_inmuebles' => 'cantidad de inmuebles',
        'numero_paginas' => 'número de páginas',
        'valor_propiedad' => 'valor de la propiedad',
        'registro_gravamen' => 'registro gravamen',
        'tomo_gravamen' => 'tomo gravamen',
        'numero_oficio' => 'número de oficio'
    ];

    public function resetearTodo(){

        $this->reset([
                        'modalBorrar',
                        'crear',
                        'editar',
                        'modal',
                        'estado',
                        'id_servicio',
                        'solicitante',
                        'seccion', 'flag_seccion',
                        'nombre_solicitante', 'flag_nombre_solicitante',
                        'numero_oficio', 'flag_numero_oficio',
                        'tomo', 'flag_tomo',
                        'folio_real', 'flag_folio_real',
                        'tomo_bis',
                        'registro', 'flag_registro',
                        'registro_bis',
                        'numero_propiedad', 'flag_numero_propiedad',
                        'distrito', 'flag_distrito',
                        'dias_de_entrega',
                        'monto',
                        'tipo_servicio',
                        'numero_inmuebles', 'flag_numero_inmuebles',
                        'numero_control',
                        'numero_escritura', 'flag_numero_escritura',
                        'numero_notaria', 'flag_numero_notaria',
                        'limite_de_pago',
                        'adiciona', 'adicionaTramite',
                        'tomo_gravamen', 'flag_tomo_gravamen',
                        'categoria_servicio',
                        'foraneo', 'flag_foraneo',
                        'registro_gravamen', 'flag_registro_gravamen',
                        'servicios',
                        'numero_paginas', 'flag_numero_paginas',
                        'valor_propiedad', 'flag_valor_propiedad',
                    ]);

        $this->resetErrorBag();
        $this->resetValidation();

    }

    public function resetFlags(){

        $this->reset([
            'flag_seccion', 'seccion',
            'flag_numero_oficio', 'numero_oficio',
            'flag_tomo', 'tomo', 'tomo_bis',
            'flag_folio_real', 'folio_real',
            'flag_registro', 'registro', 'registro_bis',
            'flag_numero_propiedad', 'numero_propiedad',
            'flag_distrito', 'distrito',
            'flag_numero_inmuebles', 'numero_inmuebles',
            'flag_numero_escritura', 'numero_escritura',
            'flag_numero_notaria', 'numero_notaria',
            'flag_tomo_gravamen', 'tomo_gravamen',
            'flag_foraneo', 'foraneo',
            'flag_registro_gravamen', 'registro_gravamen',
            'flag_numero_paginas', 'numero_paginas',
            'flag_valor_propiedad', 'valor_propiedad'
        ]);

    }

    public function updatedAdicionaTramite(){

        $this->adiciona = null;

        if($this->adicionaTramite)
            $this->dispatchBrowserEvent('select2');

    }

    public function updatedCategoriaServicio(){

        /* Buscar servicios de la categoría */

        $this->servicios = Servicio::where('estado', 'activo')->where('categoria_servicio_id', $this->categoria_servicio)->get();

        /* Al cambiar de categoría resetear inputs */

        $this->resetFlags();

    }

    public function updatedIdServicio(){

        $servicio = Servicio::find($this->id_servicio);

        $this->resetFlags();

        switch ($servicio->nombre) {
            case 'Copias simples (por página)':
                $this->flag_tomo = true;
                $this->flag_registro = true;
                $this->flag_distrito = true;
                $this->flag_seccion = true;
                $this->flag_numero_paginas = true;
                break;

            case 'Copias certificadas (por página)':
                $this->flag_tomo = true;
                $this->flag_registro = true;
                $this->flag_distrito = true;
                $this->flag_seccion = true;
                $this->flag_numero_paginas = true;
                break;

            /* case 'Cuando se trate de uno o hasta cinco tomos o libros índice':
                $this->flag_nombre_solicitante = true;
                break;

            case 'Búsqueda de bienes por índices de 21 o más':
                $this->flag_nombre_solicitante = true;
                break;

            case 'Búsqueda de bienes por índices de 11 a 20':
                $this->flag_nombre_solicitante = true;
                break;

            case 'Búsqueda de antecedente de 1 a 10':
                $this->flag_nombre_solicitante = true;
                break; */

            default:
                # code...
                break;
        }

    }

    public function updatedSolicitante(){

        if($this->solicitante == 'Ventanilla'){

            $this->flag_nombre_solicitante = true;
            $this->nombre_solicitante = null;

        }elseif($this->solicitante == 'Oficialia de partes'){

            $this->flag_nombre_solicitante = true;
            $this->nombre_solicitante = null;

        }else{
            $this->flag_nombre_solicitante = false;
            $this->nombre_solicitante = null;
        }

        if($this->solicitante == "Pensiones"){

            $this->tipo_servicio = "Extra Urgente";
            $this->updatedTipoServicio();

        }
    }

    public function updatedTipoServicio(){

        if($this->id_servicio == ""){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Debe seleccionar un servicio."]);

            $this->tipo_servicio = null;

            return;
        }

        if($this->tipo_servicio == 'Ordinario'){

            $this->dias_de_entrega = 4;
            $this->monto = Servicio::find($this->id_servicio)->ordinario;

        }
        elseif($this->tipo_servicio == 'Urgente'){

            $this->dias_de_entrega = 1;
            $this->monto = Servicio::find($this->id_servicio)->urgente;

            if($this->monto == 0){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No hay cobro urgente para el servicio seleccionado."]);

                $this->tipo_servicio = null;
            }

        }
        elseif($this->tipo_servicio == 'Extra Urgente'){

            $this->dias_de_entrega = 0;
            $this->monto = Servicio::find($this->id_servicio)->extra_urgente;

            if($this->monto == 0){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No hay cobro extra urgente para el servicio seleccionado."]);

                $this->tipo_servicio = null;
            }

        }

    }

    public function abrirModalEditar($tramite){

        $this->resetearTodo();

        $this->selected_id = $tramite['id'];
        $this->estado = $tramite['estado'];
        $this->solicitante = $tramite['solicitante'];
        $this->tomo_bis = $tramite['tomo_bis'];
        $this->registro_bis = $tramite['registro_bis'];
        $this->dias_de_entrega = $tramite['dias_de_entrega'];
        $this->monto = $tramite['monto'];
        /* $this->tipo_servicio = $tramite['tipo_servicio']; */
        $this->numero_control = $tramite['numero_control'];
        $this->limite_de_pago = $tramite['limite_de_pago'];

        $this->id_servicio = $tramite['id_servicio'];
        $servicio = Servicio::find($tramite['id_servicio']);
        $this->categoria_servicio = $servicio->categoria_servicio_id;
        $this->updatedCategoriaServicio();

        if(isset($tramite['nombre_solicitante'])){
            $this->nombre_solicitante = $tramite['nombre_solicitante'];
            $this->flag_nombre_solicitante = true;
        }

        if(isset($tramite['tomo'])){
            $this->tomo = $tramite['tomo'];
            $this->flag_tomo = true;
        }

        if(isset($tramite['folio_real'])){
            $this->folio_real = $tramite['folio_real'];
            $this->flag_folio_real = true;
        }

        if(isset($tramite['registro'])){
            $this->registro = $tramite['registro'];
            $this->flag_registro = true;
        }

        if(isset($tramite['numero_propiedad'])){
            $this->numero_propiedad = $tramite['numero_propiedad'];
            $this->flag_numero_propiedad = true;
        }

        if(isset($tramite['numero_inmuebles'])){
            $this->numero_inmuebles = $tramite['numero_inmuebles'];
            $this->flag_numero_inmuebles = true;
        }

        if(isset($tramite['distrito'])){
            $this->distrito = $tramite['distrito'];
            $this->flag_distrito = true;
        }

        if(isset($tramite['seccion'])){
            $this->seccion = $tramite['seccion'];
            $this->flag_seccion = true;
        }

        if(isset($tramite['seccion'])){
            $this->seccion = $tramite['seccion'];
            $this->flag_seccion = true;
        }

        if(isset($tramite['numero_escritura'])){
            $this->numero_escritura = $tramite['numero_escritura'];
            $this->flag_numero_escritura = true;
        }

        if(isset($tramite['numero_notaria'])){
            $this->numero_notaria = $tramite['numero_notaria'];
            $this->flag_numero_notaria = true;
        }

        if(isset($tramite['numero_notaria'])){
            $this->numero_notaria = $tramite['numero_notaria'];
            $this->flag_numero_notaria = true;
        }

        if(isset($tramite['foraneo'])){
            $this->foraneo = $tramite['foraneo'];
            $this->flag_foraneo = true;
        }

        if(isset($tramite['tomo_gravamen'])){
            $this->tomo_gravamen = $tramite['tomo_gravamen'];
            $this->flag_tomo_gravamen = true;
        }

        if(isset($tramite['registro_gravamen'])){
            $this->registro_gravamen = $tramite['registro_gravamen'];
            $this->flag_registro_gravamen = true;
        }

        if(isset($tramite['valor_propiedad'])){
            $this->valor_propiedad = $tramite['valor_propiedad'];
            $this->flag_valor_propiedad = true;
        }

        if(isset($tramite['numero_paginas'])){
            $this->numero_paginas = $tramite['numero_paginas'];
            $this->flag_numero_paginas = true;
        }

        if(isset($tramite['numero_oficio'])){
            $this->numero_oficio = $tramite['numero_oficio'];
            $this->flag_numero_oficio = true;
        }

        $this->modal = true;
        $this->editar = true;

        if(isset($tramite['adiciona'])){
            $this->adiciona = $tramite['adiciona'];
            $this->adicionaTramite = true;
            $this->dispatchBrowserEvent('select2');
        }

    }

    public function crear(){

        $this->validate();

        try {

            $numero_control = Tramite::orderBy('numero_control', 'desc')->value('numero_control');

            $monto = 0;

            if($this->foraneo){

                $monto = 1865 + (int)$this->monto;

            }else{

                $monto = (int)$this->monto;

            }

            if($this->numero_paginas != null){

                $monto = $monto * (int)$this->numero_paginas;

            }

            $tramite = Tramite::create([
                'numero_control' => $numero_control ? $numero_control + 1 : 1,
                'id_servicio' => $this->id_servicio,
                'solicitante' => $this->solicitante,
                'nombre_solicitante' => $this->nombre_solicitante,
                'tomo' => $this->tomo,
                'folio_real' => $this->folio_real,
                'tomo_bis' => $this->tomo_bis,
                'registro' => $this->registro,
                'registro_bis' => $this->registro_bis,
                'numero_propiedad' => $this->numero_propiedad,
                'numero_inmuebles' => $this->numero_inmuebles,
                'distrito' => $this->distrito,
                'seccion' => $this->seccion,
                'dias_de_entrega' => $this->dias_de_entrega,
                'monto' => $monto,
                'tipo_servicio' => $this->tipo_servicio,
                'numero_escritura' => $this->numero_escritura,
                'numero_notaria' => $this->numero_notaria,
                'limite_de_pago' => now()->addDays(10),
                'adiciona' => $this->adiciona,
                'foraneo' => $this->foraneo,
                'tomo_gravamen' => $this->tomo_gravamen,
                'registro_gravamen' => $this->registro_gravamen,
                'valor_propiedad' => $this->valor_propiedad,
                'numero_paginas' => $this->numero_paginas,
                'numero_oficio' => $this->numero_oficio,
                'estado' => 'nuevo',
                'creado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('imprimir_recibo', ['tramite' => $tramite->id]);

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

            $tramite = Tramite::find($this->selected_id);

            $tramite->update([
                'id_servicio' => $this->id_servicio,
                'solicitante' => $this->solicitante,
                'nombre_solicitante' => $this->nombre_solicitante,
                'tomo' => $this->tomo,
                'folio_real' => $this->folio_real,
                'tomo_bis' => $this->tomo_bis,
                'registro' => $this->registro,
                'registro_bis' => $this->registro_bis,
                'numero_inmuebles' => $this->numero_inmuebles,
                'numero_propiedad' => $this->numero_propiedad,
                'distrito' => $this->distrito,
                'seccion' => $this->seccion,
                'dias_de_entrega' => $this->dias_de_entrega,
                'monto' => $this->monto,
                'tipo_servicio' => $this->tipo_servicio,
                'numero_escritura' => $this->numero_escritura,
                'numero_notaria' => $this->numero_notaria,
                'limite_de_pago' => now()->addDays(10),
                'numero_paginas' => $this->numero_paginas,
                'adiciona' => $this->adiciona,
                'foraneo' => $this->foraneo,
                'actualizado_por' => auth()->user()->id
            ]);

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

            $tramite = Tramite::find($this->selected_id);

            $tramite->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El trámite se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar trámite por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }
    }

    public function mount(){

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

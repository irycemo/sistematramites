<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tramite;
use Livewire\Component;

class Consulta extends Component
{

    public $search;
    public $tramite;

    public function consultar(){

        $this->tramite = Tramite::where('numero_control', $this->search)->first();

    }

    public function render()
    {

        return view('livewire.admin.consulta')->extends('layouts.admin');
    }
}

<?php

namespace App\Models;

use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uma extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable = ['diario', 'mensual', 'anual', 'año', 'creado_por', 'actualizado_por'];
}

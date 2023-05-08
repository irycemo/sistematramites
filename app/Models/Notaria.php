<?php

namespace App\Models;

use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notaria extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable = ['numero', 'notario', 'email', 'rfc', 'creado_por', 'actualizado_por'];
}

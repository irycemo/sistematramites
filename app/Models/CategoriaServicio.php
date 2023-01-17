<?php

namespace App\Models;

use App\Models\Servicio;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class CategoriaServicio extends Model implements Auditable
{
    use HasFactory;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['nombre', 'concepto', 'seccion'];

    public function servicios(){
        return $this->hasMany(Servicio::class);
    }
}

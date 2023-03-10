<?php

namespace App\Models;

use Carbon\Carbon;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Tramite extends Model implements Auditable
{
    use HasFactory;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function adicionaAlTramite(){
        return $this->belongsTo(Tramite::class, 'adiciona');
    }

    public function servicio(){
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    public function files(){
        return $this->morphMany(File::class, 'fileable');
    }
}

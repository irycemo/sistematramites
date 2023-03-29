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

    protected $casts = [
        'limite_de_pago' => 'date'
    ];

    public function getEstadoColorAttribute()
    {
        return [
            'nuevo' => 'blue',
            'pagado' => 'green',
            'inactivo' => 'red',
            'concluido' => 'gray',
            'rechazado' => 'red',
            'expirado' => 'red',
            'procesando' => 'yellow',
            'revission' => 'yellow',
            'recibido' => 'blue',
            'finalizado' => 'gray',
        ][$this->estado] ?? 'gray';
    }

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

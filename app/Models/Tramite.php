<?php

namespace App\Models;

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
        'limite_de_pago' => 'date',
        'fecha_entrega' => 'date',
        'fecha_pago' => 'date',
    ];

    public function getEstadoColorAttribute()
    {
        return [
            'nuevo' => 'blue-400',
            'pagado' => 'green-400',
            'inactivo' => 'red-400',
            'concluido' => 'gray-400',
            'rechazado' => 'red-400',
            'expirado' => 'red-400',
            'procesando' => 'emerald-400',
            'revision' => 'orange-400',
            'recibido' => 'yellow-400',
            'finalizado' => 'gray-800',
        ][$this->estado] ?? 'gray-400';
    }

    public function adicionaAlTramite(){
        return $this->belongsTo(Tramite::class, 'adiciona');
    }

    public function adicionadoPor(){
        return $this->hasMany(Tramtie::class, 'adiciona');
    }

    public function servicio(){
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    public function files(){
        return $this->morphMany(File::class, 'fileable');
    }

    public function recibidoPor(){
        return $this->belongsTo(User::class, 'recibido_por');
    }
}

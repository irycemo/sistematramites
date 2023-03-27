<?php

namespace App\Observers;

use App\Models\Tramite;
use App\Http\Services\SistemaRpp\SistemaRppService;

class TramiteObserver
{
    /**
     * Handle the Tramite "created" event.
     */
    public function created(Tramite $tramite): void
    {
        if($tramite->estado == 'pagado'){

            $tramite->load('servicio.categoria');

            (new SistemaRppService())->insertarSistemaRpp($tramite);

        }

    }

    /**
     * Handle the Tramite "updated" event.
     */
    public function updated(Tramite $tramite): void
    {

        if($tramite->estado == 'pagado'){

            $tramite->load('servicio.categoria');

            (new SistemaRppService())->insertarSistemaRpp($tramite);

        }

    }

    /**
     * Handle the Tramite "deleted" event.
     */
    public function deleted(Tramite $tramite): void
    {
        //
    }

    /**
     * Handle the Tramite "restored" event.
     */
    public function restored(Tramite $tramite): void
    {
        //
    }

    /**
     * Handle the Tramite "force deleted" event.
     */
    public function forceDeleted(Tramite $tramite): void
    {
        //
    }
}

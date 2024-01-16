<?php

namespace App\Observers;

use App\Models\Colaborador;

class ColaboradorObserver
{
    /**
     * Handle the Colaborador "created" event.
     *
     * @param  \App\Models\Colaborador  $colaborador
     * @return void
     */
    public function created(Colaborador $colaborador)
    {
        //dd($colaborador->getAttributes());
    }

    /**
     * Handle the Colaborador "updated" event.
     *
     * @param  \App\Models\Colaborador  $colaborador
     * @return void
     */
    public function updated(Colaborador $colaborador)
    {
        //dd($colaborador->getAttributes());
    }

    /**
     * Handle the Colaborador "deleted" event.
     *
     * @param  \App\Models\Colaborador  $colaborador
     * @return void
     */
    public function deleted(Colaborador $colaborador)
    {
        //dd($colaborador->getAttributes());
    }

    /**
     * Handle the Colaborador "restored" event.
     *
     * @param  \App\Models\Colaborador  $colaborador
     * @return void
     */
    public function restored(Colaborador $colaborador)
    {
        //
    }

    /**
     * Handle the Colaborador "force deleted" event.
     *
     * @param  \App\Models\Colaborador  $colaborador
     * @return void
     */
    public function forceDeleted(Colaborador $colaborador)
    {
        //
    }
}

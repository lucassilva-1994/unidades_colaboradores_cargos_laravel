<?php

namespace App\Observers;

use App\Models\Unidade;

class UnidadeObserver
{
    /**
     * Handle the Unidade "created" event.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return void
     */
    public function created(Unidade $unidade)
    {
        //dd('Criado');
    }

    /**
     * Handle the Unidade "updated" event.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return void
     */
    public function updated(Unidade $unidade)
    {
        //dd('Atualizado');
    }

    /**
     * Handle the Unidade "deleted" event.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return void
     */
    public function deleted(Unidade $unidade)
    {
        //dd('Deletado');
    }

    /**
     * Handle the Unidade "restored" event.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return void
     */
    public function restored(Unidade $unidade)
    {
        //
    }

    /**
     * Handle the Unidade "force deleted" event.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return void
     */
    public function forceDeleted(Unidade $unidade)
    {
        //
    }
}

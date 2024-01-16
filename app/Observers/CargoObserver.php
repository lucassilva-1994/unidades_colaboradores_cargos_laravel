<?php

namespace App\Observers;

use App\Models\Cargo;

class CargoObserver
{
    /**
     * Handle the Cargo "created" event.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return void
     */
    public function created(Cargo $cargo)
    {
        
    }

    /**
     * Handle the Cargo "updated" event.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return void
     */
    public function updated(Cargo $cargo)
    {
       
    }

    /**
     * Handle the Cargo "deleted" event.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return void
     */
    public function deleted(Cargo $cargo)
    {
        
    }

    /**
     * Handle the Cargo "restored" event.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return void
     */
    public function restored(Cargo $cargo)
    {
        //
    }

    /**
     * Handle the Cargo "force deleted" event.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return void
     */
    public function forceDeleted(Cargo $cargo)
    {
        //
    }
}

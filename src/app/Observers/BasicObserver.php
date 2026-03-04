<?php

namespace App\Observers;

use App\Models\Basic\Basic;

class BasicObserver {
    /**
     * Handle the Basic "created" event.
     */
    public function created(Basic $basic): void {
        //
    }

    /**
     * Handle the Basic "updated" event.
     */
    public function updated(Basic $basic): void {
        //
    }

    /**
     * Handle the Basic "deleted" event.
     */
    public function deleted(Basic $basic): void {
        //
    }

    /**
     * Handle the Basic "restored" event.
     */
    public function restored(Basic $basic): void {
        //
    }

    /**
     * Handle the Basic "force deleted" event.
     */
    public function forceDeleted(Basic $basic): void {
        //
    }
}

<?php

namespace MesCore\Auth\Observers;

use MesCore\Auth\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver {

    public function creating( User $user ): void {
        if( Auth::check() ) {
            $user->CREATE_ACCOUNT_IDX = Auth::id();
        }
    }

    public function created( User $user ): void {

    }

    public function updating( User $user ): void {
        if( Auth::check() ) {
            $user->UPDATE_ACCOUNT_IDX = Auth::id();
        }
    }

    public function updated( User $user ): void {

    }
}

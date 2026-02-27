<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\AdminMenuComposer;
use App\Http\View\Composers\UserMenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\User\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider {
    public function register(): void {
    }

    public function boot(): void {
        User::observe(UserObserver::class);

        View::composer('frame.leftMenu', AdminMenuComposer::class);
        View::composer('frame.topFrame', UserMenuComposer::class);

        View::composer('*', function ($view) {
            $sessionData = (object) [
                'userId'    => Session::get('user_id'),
                'userIdx'   => Session::get('user_idx'),
                'userLevel' => Session::get('user_level'),
                'userName'  => Session::get('user_name'),
                'partCode'  => Session::get('part_code'),
            ];
            $view->with('mSession', $sessionData);
        });
    }
}

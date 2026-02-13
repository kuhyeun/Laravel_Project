<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\User\User; // User 모델을 use
use App\Observers\UserObserver; // UserObserver를 use

class AppServiceProvider extends ServiceProvider {
    public function register(): void {
    }

    public function boot(): void {
        User::observe(UserObserver::class);

        View::composer('*', function ($view) {
            $sessionData = (object) [
                'userId'    => Session::get('user_id'),
                'userIdx'   => Session::get('user_idx'),
                'userLevel' => Session::get('user_level'),
                'userName'  => Session::get('user_name'),
                'partCode'  => Session::get('part_code'),
            ];

            $userMenu = [
                (object)['name' => 'Dashboard', 'location' => '/dashboard', 'on' => 'Y'],
                (object)['name' => 'Profile', 'location' => '/profile', 'on' => 'N'],
            ];
            $adminMenu = [
                (object)['name' => 'Admin Dashboard', 'location' => '/admin', 'on' => 'Y'],
                (object)['name' => 'User Management', 'location' => '/admin/users', 'on' => 'N'],
            ];

            $view->with('mSession', $sessionData)
                 ->with('userMenu', $userMenu)
                 ->with('adminMenu', $adminMenu);
        });
    }
}

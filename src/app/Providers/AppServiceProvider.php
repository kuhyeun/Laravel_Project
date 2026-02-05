<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\User\Login; // Login 모델을 use
use App\Observers\LoginObserver; // LoginObserver를 use

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        // PointService registration removed
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        // Login 모델에 LoginObserver를 등록합니다.
        Login::observe(LoginObserver::class);

        // This is the Laravel equivalent of the logic in MK_Custom's constructor.
        // It shares common data with all views.
        View::composer('*', function ($view) {
            
            // 1. Get Session Data (equivalent to getSessionData)
            $sessionData = (object) [
                'userId'    => Session::get('user_id'),
                'userIdx'   => Session::get('user_idx'),
                'userLevel' => Session::get('user_level'),
                'userName'  => Session::get('user_name'),
                'partCode'  => Session::get('part_code'),
            ];

            // 2. Get Config Data (equivalent to getConfigData)
            // We'll mock this. In a real app, this might come from a DB table or config file.
            $configData = (object) [
                'SEND_SMS' => 'Y',
                'SEND_FRIEND_TALK' => 'Y',
                'EXTERNAL_SEND' => 'Y',
                'USE_GROUP_POINT' => 'Y', // This was related to points but can be a general setting
            ];

            // 3. Get Menu Data (equivalent to getMenuData)
            // Mocking menu data. This would typically come from a Menu model.
            $userMenu = [
                (object)['name' => 'Dashboard', 'location' => '/dashboard', 'on' => 'Y'],
                (object)['name' => 'Profile', 'location' => '/profile', 'on' => 'N'],
            ];
            $adminMenu = [
                (object)['name' => 'Admin Dashboard', 'location' => '/admin', 'on' => 'Y'],
                (object)['name' => 'User Management', 'location' => '/admin/users', 'on' => 'N'],
            ];

            // Share the data with the view (pointData is removed)
            $view->with('mSession', $sessionData)
                 ->with('configData', $configData)
                 ->with('userMenu', $userMenu)
                 ->with('adminMenu', $adminMenu);
        });
    }
}

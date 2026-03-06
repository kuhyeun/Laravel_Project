<?php

namespace App\Http\Controllers;

use App\Models\Menu\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller {

    public function insertUserMenu( Request $request ) {
        try {
            $menu = Menu::createUserMenu( $request );

            return response()->json([
                'message' => 'Success',
                'menu' => $menu
            ], 200 );
        } catch( \Throwable $e ) {
            Log::error( '사용자 메뉴 생성 실패 : '. $e->getMessage() );

            return response()->json([
                'message' => 'Failed'
            ], 500 );
        }
    }

    public function insertAdminMenu( Request $request ) {
        try {
            $menu = Menu::createAdminMenu( $request );

            return response()->json([
                'message' => 'Success',
                'menu' => $menu
            ], 200 );
        } catch( \Throwable $e ) {
            Log::error( '관리자 메뉴 생성 실패 : '. $e->getMessage() );

            return response()->json([
                'message' => 'Failed'
            ], 500 );
        }
    }

    public function updateUserMenu( Request $request ) {}
    public function updateAdminMenu( Request $request ) {}
    public function deleteUserMenu( Request $request ) {}
    public function deleteAdminMenu( Request $request ) {}
}

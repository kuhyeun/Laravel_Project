<?php

namespace MesCore\Basic\Controllers;

use MesCore\Http\Controller;
use Inertia\Inertia;

class BasicController extends Controller {
    
    public function codeManage() {
        return Inertia::render( 'Basic/CodeManage' );
    }

    public function menuManage() {
        return Inertia::render( 'Basic/MenuManage' );
    }

    public function member() {
        return Inertia::render( 'Basic/Member' );
    }

    public function memberAuth() {
        return Inertia::render( 'Basic/MemberAuth' );
    }

    public function preferences() {
        return Inertia::render( 'Basic/Preferences' );
    }

    public function systemConfig() {
        return Inertia::render( 'Basic/SystemConfig' );
    }
}

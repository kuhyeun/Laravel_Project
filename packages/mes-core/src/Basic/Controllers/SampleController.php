<?php

namespace MesCore\Basic\Controllers;

use MesCore\Http\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SampleController extends Controller {
    
    public function barChart() {
        return Inertia::render( 'Sample/BarChart' );
    }
    
    public function lineChart() {
        return Inertia::render( 'Sample/LineChart' );
    }

    public function circleChart() {
        return Inertia::render( 'Sample/CircleChart' );
    }

    public function comboChart() {
        return Inertia::render( 'Sample/ComboChart' );
    }

    public function api() {
        return Inertia::render( 'Sample/ApiSample' );
    }

    public function apiGet( Request $request ) {
        $requestParams = $request->all(); // 모든 데이터 조회
        $requestHas    = $request->has( 'type' ); // 해당 키가 있는지 확인
        $requestByKey  = $request->input( 'type' ); // GET,POST 상관없음
        $requestOnly   = $request->only( ['item_name', 'item_code'] ); // 특정키만 조회
        $requestGetParams = $request->query( 'type' ); // GET 파라미터만 조회

        $data = ['requestParams' => $requestParams,
                 'requestHas' => $requestHas,
                 'requestByKey' => $requestByKey,
                 'requestOnly' => $requestOnly,
                 'requestGetParams' => $requestGetParams ];
        
        return response()->json( $data );
    }

    public function apiPost( Request $request ) {
        $requestParams = $request->all(); // 모든 데이터 조회
        $requestHas    = $request->has( 'type' ); // 해당 키가 있는지 확인
        $requestByKey  = $request->input( 'type' ); // GET,POST 상관없음
        $requestOnly   = $request->only( ['item_name', 'item_code'] ); // 특정키만 조회
        $requestGetParams = $request->query( 'type' ); // GET 파라미터만 조회

        $data = ['requestParams' => $requestParams,
                 'requestHas' => $requestHas,
                 'requestByKey' => $requestByKey,
                 'requestOnly' => $requestOnly,
                 'requestGetParams' => $requestGetParams ];
        
        return response()->json( $data );
    }
}
<?php

namespace MesCore\Basic\Controllers;

use MesCore\Http\Controller;
use Inertia\Inertia;

class SampleController extends Controller {
    
    public function barChart() {
        return Inertia::render( 'Sample/BarChart' );
    }
    
    public function lineChart() {
        return Inertia::render( 'Sample/LineChart' );
    }

    public function circleChart() {
        return Inertia::render( 'Sample/PieChart' );
    }
}
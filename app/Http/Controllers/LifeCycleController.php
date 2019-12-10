<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Contractstate;
use App\Lifecycles;
use Illuminate\Http\Request;

class LifeCycleController extends Controller
{
    public function index(){
        
        $lifecicle = Lifecycles::orderBy('from_id')->get();
        $nameCicle = Contractstate::all();
        return view('lifeCycle/lifecycleedit')->with(
            [
                'lifecicle' => $lifecicle,
                'namecicle' => $nameCicle,
            ]
        );

    }
    //
}

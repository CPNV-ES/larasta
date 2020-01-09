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
                'lifecycle' => $lifecicle,
                'namecycle' => $nameCicle,
            ]
        );
    }
    public function ModifyLifeCycleCell(Request $request){
        $data = json_decode($request->getContent());
        Lifecycles::truncate();
        foreach($data as $cycle){
            $Lifecycles = new Lifecycles();
            $Lifecycles->from_id = $cycle->from;
            $Lifecycles->to_id = $cycle->to;
            $Lifecycles->save();
        }
    }
    public function ModifyLifeCycleTitle(Request $request){
        $data = json_decode($request->getContent());
        foreach($data as $title){
            Contractstate::where('id',$title->id)->update(['stateDescription' => $title->value]);
        }
        echo json_encode(array('status' => 'ok'));
    }
    //
}

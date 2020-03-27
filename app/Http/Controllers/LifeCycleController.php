<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Contractstate;
use App\Lifecycle;
use Error;
use Illuminate\Http\Request;

class LifeCycleController extends Controller
{
    public function index()
    {   
        foreach(Contractstate::all() as $from){
            foreach($from->contractStates as $to){
                $lifecycle[$from->id][$to->id] = "";
            }
        }
        $namecycle = Contractstate::all();
        return view('lifeCycle/lifecycleedit',compact('lifecycle', 'namecycle'));
    }

    public function ModifyLifeCycleCell(Request $request)
    {
        $data = json_decode($request->getContent());
            Lifecycle::query()->delete();
            foreach($data as $cycle)
            {
                $lifecycle = new Lifecycle();
                $lifecycle->modifyLifeCycleData($cycle);
            }
    }

    public function ModifyContractStateTitle(Request $request)
    {
        $data = json_decode($request->getContent());
        $contractstate = new Contractstate();
        $contractstate->modifyContractCellTitle($data);
    }
    public function addEmptyContractState(Request $request)
    {
        $contractState = new Contractstate;
        $contractState->addEmptyContractState();
        return redirect('/editlifecycle');
    }

    public function removeLifeCycleState(Request $request)
    {
        Contractstate::find($request->id)->delete();
        return redirect('/editlifecycle');
    }
    //
}

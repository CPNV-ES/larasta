<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Contractstate;
use App\Lifecycle;
use Illuminate\Http\Request;

class LifeCycleController extends Controller
{
    public function index()
    {
        
        $lifecicle = Lifecycle::orderBy('from_id')->get();
        $nameCicle = Contractstate::all();
        return view('lifeCycle/lifecycleedit')->with(
            [
                'lifecycle' => $lifecicle,
                'namecycle' => $nameCicle,
            ]
        );
    }

    public function ModifyLifeCycleCell(Request $request)
    {
        $data = json_decode($request->getContent());
        Lifecycle::query()->delete();
        foreach($data as $cycle)
        {
            $lifecicle = new Lifecycle();
            $lifecicle->modifyLifeCycleData($cycle);
        }
    }

    public function ModifyContractStateTitle(Request $request)
    {
        $data = json_decode($request->getContent());
        $contractstate = new Contractstate();
        $contractstate->modifyContractCellTitle($data);
        echo json_encode(array('status' => 'ok'));
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

<?php

namespace App\Http\Controllers;

use App\Params;
use Illuminate\Http\Request;

class ParamsController extends Controller
{
    public function index(){
        $params = Params::all();

        return view('admin/params')->with('params', $params);
    }

    public function update(Request $request) {
        foreach($request->all()["params"] as $param_name => $param) {
            $p = Params::getParamByName($param_name);
            // Update the Param with the new value depending on its type
            switch($param["type"]) {
                case "text":
                    $p->paramValueText = $param["value"];
                    $p->save();
                    break;
                case "int":
                    $p->paramValueInt = $param["value"];
                    $p->save();
                    break;
                case "date":
                    $p->paramValueDate = $param["value"]["date"] . ' ' . $param["value"]["time"];
                    $p->save();
                    break;
            }
        }

        return redirect()->back()->with('status', 'Paramètres sauvés avec succès');
    }
}

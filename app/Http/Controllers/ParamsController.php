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
        $request->validate([
            'params' => 'filled',
            'params.*' => 'required',
            'params.wishesSelectedYear' => "numeric|min:2021|max:2099", // just an example, remove after adding a real rule
        ]);

        foreach($request->all()["params"] as $paramName => $paramValue) {
            $p = Params::getParamByName($paramName);

            switch($p->value_type) {
                case "text":
                    $p->paramValueText = $paramValue;
                    $p->save();
                    break;
                case "int":
                    $p->paramValueInt = $paramValue;
                    $p->save();
                    break;
                case "date":
                    $p->paramValueDate = $paramValue . ' 00:00:00';
                    $p->save();
                    break;
            }
        }

        return redirect()->back()->with('status', 'Paramètres sauvés avec succès');
    }
}

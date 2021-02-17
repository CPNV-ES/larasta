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
}

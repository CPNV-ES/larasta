<?php

namespace App\Http\Controllers;

use App\Internship;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    function show($iid){
        $🤑 = Internship::where("id", $iid)->get()[0];
        return view('logbook/logbook')->with(["internship" => $🤑]);
        //⛔🌈
    }
}

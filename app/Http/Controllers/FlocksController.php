<?php

namespace App\Http\Controllers;

use App\Company;
use App\Flock;
use App\Internship;
use Illuminate\Http\Request;

class FlocksController extends Controller
{
    public function index(){
        $flocks = Flock::all();

        return view('admin/flocks')->with('flocks', $flocks); //->with('companies', $companies);
    }
}

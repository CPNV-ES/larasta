<?php

namespace App\Http\Controllers;

use App\Synchro;
use Illuminate\Http\Request;

class SynchroController extends Controller
{
    public function index()
    {
        return view('synchro/index');
    }
}
<?php

/*
 * Title: VisitsController.php
 * Author: Jean-Yves Le
 * Creation date : 12 Dec 2017
 * Modification date : 12 Dec 2017
 * Version : 1.0
 *
 * */


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitsController extends Controller
{
    public function index()
    {
        return view('visits/visits');
    }

    public function manage()
    {
        return view('visits/manage');
    }
}

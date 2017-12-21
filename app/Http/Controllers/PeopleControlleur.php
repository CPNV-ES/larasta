<?php
/**
 * Created by PhpStorm.
 * User: Davide.CARBONI
 * Date: 18.12.2017
 * Time: 09:06
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeopleControlleur extends Controller
{
    // index, base route
    public function index()
    {
        return view('listPeople/people');
    }
}
<?php

namespace App\Http\Controllers;

use App\Company;
use App\Internship;
use Illuminate\Http\Request;

class MailingController extends Controller
{
    //
    public function mailling(){
        $companies = new Company;
        $companies = $companies->getCompanyByLastInternships();

        return view('admin/mailing')->with('companies', $companies);
    }
}

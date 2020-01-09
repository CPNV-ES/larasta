<?php

namespace App\Http\Controllers;

use App\Company;
use App\Internship;
use Illuminate\Http\Request;

class MailingController extends Controller
{
    //
    public function index(){
        $companies = Company::has('internship')->get()->sortByDesc(function ($company){
           return $company->internship->max('endDate');
        });

        return view('admin/mailing')->with('companies', $companies);
    }
}

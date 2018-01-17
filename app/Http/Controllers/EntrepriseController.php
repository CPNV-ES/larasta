<?php

namespace App\Http\Controllers;
use CPNVEnvironment\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EntrepriseController extends Controller
{
    public function index($id){
        $user = Environment::currentUser();

        $company = DB::table('companies')
            ->join('locations', 'location_id', '=', 'locations.id')
            ->join('contracts', 'contracts_id','=', 'contracts.id')
            ->select('companyName','address1','address2','postalCode','city','contractType', 'contracts_id','lat','lng')
            ->where('companies.id',$id)
            ->get();

        $persons = DB::table('persons')
            ->select('firstname', 'lastname', 'id', 'obsolete')
            ->where('company_id','=',$id)
            ->get();

        $contacts = DB::table('contactinfos')
            ->join('persons','persons.id','=','persons_id')
            ->select('contacttypes_id','value','firstname','lastname','persons.id as personId')
            ->where('company_id','=',$id)
            ->get();

        $iships = DB::table('internships')
            ->join('companies', 'companies_id', '=', 'companies.id')
            ->join('persons as admresp', 'admin_id', '=', 'admresp.id')
            ->join('persons as intresp', 'responsible_id', '=', 'intresp.id')
            ->join('persons as student', 'intern_id', '=', 'student.id')
            ->join('contractstates', 'contractstate_id', '=', 'contractstates.id')
            ->select(
                'internships.id',
                'beginDate',
                'companyName',
                'admresp.firstname as arespfirstname',
                'admresp.lastname as aresplastname',
                'intresp.firstname as irespfirstname',
                'intresp.lastname as iresplastname',
                'student.firstname as studentfirstname',
                'student.lastname as studentlastname',
                'contractstate_id','stateDescription')
            ->where('companies.id', $id)
            ->get();

        $remarks = DB::table('remarks')
            ->select('id','remarkDate','author','remarkText')
            ->where('remarkType',1)
            ->where('remarkOn_id', $id)
            ->get();

        return view('/entreprises/entreprise')->with(['company' => $company, 'user' => $user, 'persons' => $persons, 'contacts' => $contacts,  'iships'=>$iships, 'remarks'=>$remarks]);
    }

    public function save(Request $request, $id){  // $request data : address1, address2, npa, city, ctype

        DB::table('companies')
            ->where('id',$id)
            ->update(['contracts_id' => $request->ctype]);

        DB::table('locations')
            ->where('id',$id)
            ->update(['address1' => $request->address1]); //->update('address2', $request->address2); //, 'postalCode' => $request->npa, 'city' => $request->city]);

        return $this->index($id);
    }

    public function remove($id){
        DB::table('internships')
            ->where('companies_id', $id)
            ->delete();

        DB::table('locations')
            ->where('id', $id)
            ->delete();

        DB::table('companies')
            ->where('id', $id)
            ->delete();
    }
}

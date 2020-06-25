<?php
/**
 * Created by antonio.giordano
 * Date: 08.01.2018
 */

namespace App\Http\Controllers;
use CPNVEnvironment\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class EntreprisesController extends Controller
{

    /**
     * Display a list of all company
     * @return $this
     */
    public function index()
    {
        $user = Auth::user();

        $companies = DB::table('companies')
            ->join('locations', 'location_id', '=', 'locations.id')
            ->select('companies.id','companyName','address1','address2','postalCode','city')
            ->orderBy('companyName','asc')
            ->get();

        $eType = DB::table('contracts') // Get the contracts for filter
            ->select('id', 'contractType')
            ->get();

        return view('entreprises/entreprises')->with(['companies' => $companies, 'user' => $user, 'contracts' => $eType]);
    }


    /**
     * Create a new company
     * @param Request $request (nameE)
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request){
        $id = DB::table('locations')->insertGetId(['address1'=>null]); // Create row for location

        $id = DB::table('companies')->insertGetId( // Create new company
            ['companyName' => $request->nameE, 'contracts_id' => 3,'location_id'=>$id]
        );
        return redirect('entreprise/'.$id); // Go on details page of the new company created
    }

    /**
     * Get the filter and display
     * @param Request $request (type)
     * @return $this
     */
    public function filter(Request $request)
    {
        if ($request->type == 0) // When type = 0, show all company
        {
            $companies = DB::table('companies')
                ->join('locations', 'location_id', '=', 'locations.id')
                ->select('companies.id','companyName','address1','address2','postalCode','city')
                ->get();
        }
        else // Show only company when contracts_id = type
        {
            $companies = DB::table('companies')
                ->join('locations', 'location_id', '=', 'locations.id')
                ->select('companies.id','companyName','address1','address2','postalCode','city')
                ->where('contracts_id', $request->type)
                ->get();
        }

        $eType = DB::table('contracts')
            ->select('id', 'contractType')
            ->get();

        $user = Auth::user();

        return view('entreprises/entreprises')->with(['companies' => $companies, 'user' => $user, 'filtr' => $request->type,  'contracts' => $eType]);
    }


}

<?php

/**
 * Author :         Quentin Neves
 * Created :        12.12.2017
 * Updated :        24.01.2018
 * Version :        1.0
 * Description :    This controller is used for generating internship contract using intern informations and gender
 *                  and display it
 */


namespace App\Http\Controllers;

use App\Companies;
use App\Contract;
use App\Persons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class ContractController extends Controller
{
    /**
     * Used to pass data to contractGenerate view, which will decide if we can generate the contract
     *ddrt
     * @param $iid id of the current internship
     * @return $this contains the date when the contract has been generated
     */
    public function generateContract($iid)
    {
        $iDate = DB::table('internships')
            ->select('contractGenerated')
            ->where('id', $iid)
            ->first();

        return view('contract/contractGenerate')->with(['iDate' => $iDate, 'iid' => $iid]);
    }

    /**
     * Replace markups from contract template with corresponding data
     *
     * @param $iid
     * @param Request $request get data in post request
     * @return $this contains generated contract
     */
    public function visualizeContract($iid, Request $request)
    {

        $contract = $this->getContract($iid);

        /*
         *  Search for anything between { } and trim them by groups so $out[] contains :
         *      0 => Markups to replace
         *      1 => Replacing string, male
         *      2 => Only contains female replacing string
         */

        preg_match_all("/{{1,2}([^{}|]+)\s*(?:\|\s*([^{}]+))?}{1,2}/", $contract[0]->contractText, $out);

        // Tracks on which regex match we're working with
        $i = 0;

        foreach ($out[0] as $markup) // For each markup found
        {
            if (substr($markup,0,2) === '{{') // If we must accord the gender
            {
                if ($request->gender === 'male')
                {
                    $contract[0]->contractText = str_replace($markup, $out[1][$i], $contract[0]->contractText);
                }
                else
                {
                    $contract[0]->contractText = str_replace($markup, $out[2][$i], $contract[0]->contractText);
                }

            }
            else // else we must insert data
            {
                switch ($out[0][$i]){
                    case '{train_PrenomPersonne}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[1]->firstname, $contract[0]->contractText);
                        break;
                    case '{train_NomPersonne}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[1]->lastname, $contract[0]->contractText);
                        break;
                    case '{train_Adresse1}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[1]->address1, $contract[0]->contractText);
                        break;
                    case '{train_Adresse2}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[1]->address2, $contract[0]->contractText);
                        break;
                    case '{train_NPA}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[1]->postalCode, $contract[0]->contractText);
                        break;
                    case '{train_Localite}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[1]->city, $contract[0]->contractText);
                        break;
                    case '{corp_NomEntreprise}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[2]->companyName, $contract[0]->contractText);
                        break;
                    case '{corp_Adresse1}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[1]->address1, $contract[0]->contractText);
                        break;
                    case '{corp_Adresse2}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[1]->address2, $contract[0]->contractText);
                        break;
                    case '{corp_NPA}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[1]->postalCode, $contract[0]->contractText);
                        break;
                    case '{corp_Localite}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[1]->city, $contract[0]->contractText);
                        break;
                    case '{Debut}':
                        $contract[0]->contractText = str_replace($out[0][$i], date('d F Y', strtotime($contract[0]->beginDate)), $contract[0]->contractText);
                        break;
                    case '{Fin}':
                        $contract[0]->contractText = str_replace($out[0][$i], date('d F Y', strtotime($contract[0]->endDate)), $contract[0]->contractText);
                        break;
                    case '{resp_PrenomPersonne}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[3]->firstName, $contract[0]->contractText);
                        break;
                    case '{resp_NomPersonne}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[3]->lastName, $contract[0]->contractText);
                        break;
                    case '{SalaireBrut}':
                        $contract[0]->contractText = str_replace($out[0][$i], $contract[0]->grossSalary, $contract[0]->contractText);
                        break;
                    case '{date}':
                        $date = Carbon::now();
                        $contract[0]->contractText = str_replace($out[0][$i], date('d F Y', strtotime($date)), $contract[0]->contractText);
                        break;
                }
            }
            $i++;
        }

        return view('contract/contractVisualize')->with(['iid' => $iid, 'contract' => $contract, 'out' => $out, 'request' => $request]);
    }

    /**
     * Queries to retrive all contract related datas needed to generate it
     *
     * @param $iid
     * @return array
     */
    public  function getContract($id)
    {
        $contract = DB::table('contracts')
            ->join('companies', 'contracts_id', '=', 'contracts.id')
            ->join('internships', 'companies_id', '=', 'companies.id')
            ->select('contractText', 'grossSalary','internships.beginDate', 'internships.endDate')
            ->where('internships.id', $id)
            ->first();
        //
        $contract = Contract::whereHas('companies.Internships',function ($query)use ($id){
            $query->where('internships.id', $id);
        })->first();

        $intern = DB::table('persons')
            ->join('internships', 'intern_id', '=', 'persons.id')
            ->join('locations', 'location_id', '=', 'locations.id')
            ->where('internships.id', $id)
            ->select('firstname', 'lastname', 'locations.address1', 'locations.address2', 'locations.postalCode', 'locations.city')
            ->first();

        $intern = Persons::whereHas("student",function ($query)use ($id){
            $query->where('internships.id', $id);
        })->first();

        $company = DB::table('companies')
            ->join('internships', 'companies_id', '=', 'companies.id')
            ->join('locations', 'location_id', '=', 'locations.id')
            ->where('internships.id', $id)
            ->select('companyName', 'locations.address1', 'locations.address2', 'locations.postalCode', 'locations.city')
            ->first();

        $company = Companies::whereHas("Internships",function ($query)use ($id){
            $query->where('internships.id', $id);
        })->first();

        $responsible = DB::table('persons')
            ->join('internships', 'responsible_id', '=', 'persons.id')
            ->where('internships.id', $id)
            ->select('firstName', 'lastName')
            ->first();

        $responsible = Persons::whereHas("responsible",function ($query)use ($id){
            $query->where('internships.id', $id);
        })->first();

        return array($contract, $intern, $company, $responsible);
    }

    /**
     * Updates the data where the contract has been generated or create the pdf file
     *
     * @param $iid
     * @param Request $request contains the generated contract text
     * @return $pdf->stream() displays the contract in a view form which you can print it or download it
     * @return ContractController
     */
    public function saveContract($iid, Request $request)
    {
        $date = Carbon::now();

        DB::table('internships')
            ->where('id', $iid)
            ->update(['contractGenerated' => $date]);

        if ($request->pdf == 'pdf')
        {
            $pdf = App::make('dompdf.wrapper');             // Creates an "empty" pdf file
            $pdf->loadHTML($request->contractText);         // Inserts text into the file and converts markups into style
            return $pdf->stream('Contract-'.$iid.'.pdf');   // Finalize pdf file, name it and send to download
        }
        return $this->generateContract($iid);
    }

    /**
     * Deletes the date where the contract has been generated
     *
     * @param $iid
     * @return $this
     */
    public function cancelContract($iid)
    {
        DB::table('internships')
            ->where('id', $iid)
            ->update(['contractGenerated' => null]);

        // Instantiate the internship controller to get back to the internship view
        $internshipController = new InternshipsController();
        return $internshipController->edit($iid);
    }
}

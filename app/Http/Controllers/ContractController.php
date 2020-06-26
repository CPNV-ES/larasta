<?php

/**
 * Author :         Quentin Neves
 * Created :        12.12.2017
 * Updated :        14.10.2019 by Diogo Vieira Ferreira
 * Updates informations:    14.10.2019 :    All request use Eloquent system, delete one intermediate method  and change all iid by id...
 *                                          Now visualizeContract method generate a contract with correctly data.
 *                                          SaveContract method, update the date of contractGenerated field on internship table.
 * Version :        1.1
 * Description :    This controller is used for generating internship contract using intern informations and gender
 *                  and display it
 */


namespace App\Http\Controllers;

use App\Company;
use App\Contract;
use App\Internship;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class ContractController extends Controller
{
    /**
     * Send the generate date of our contract and depending on values, the view contractGenerate show differents informations
     *
     * @param $id id of the current internship
     * @return date of generated contract and id of internship
     */
    public function generateContract($id)
    {
        $internship = Internship::where("id",$id)->first();
        return view('contract/contractGenerate')->with(['contractGenerated' => $internship->contractGenerated, 'id' => $id]);
    }

    /**
     * Search specific contract and replace all markups
     * by specific data get in database
     *
     * @param $id
     * @param Request $request get data in post request
     * @return contract data and id of internship
     */
    public function visualizeContract($id, Request $request)
    {
        //Get informations of internship
        $internship = Internship::find($id);
        //Get contract of specific internships
        $contract =$internship->company->contract;
        //Get data of student on internship
        $intern = $internship->student;
        //Get company where student work
        $company = $internship->company;
        //Who is the responsible of student
        $responsible = $internship->responsible;

        /*
         *  Search for anything between { } and trim them by groups so $out[] contains :
         *      0 => Universal pronoun
         *      1 => Male pronoun
         *      2 => Female pronoun
         */
        preg_match_all("/{{1,2}([^{}|]+)\s*(?:\|\s*([^{}]+))?}{1,2}/", $contract->contractText, $out);
        $markups=$out[0];
        $markupsMale=$out[1];
        $markupsFemale=$out[2];

        //Search on our contract all data we have to modify values
        foreach ($markups as $index => $markup)//each markup has an index
        {
            //when we have to choice between female or male pronoun, our markup starts with {{
            if (substr($markup,0,2) === '{{')
            {
                if ($request->gender === 'male')
                {
                    $contract->contractText = str_replace($markup, $markupsMale[$index], $contract->contractText);
                }
                else
                {
                    $contract->contractText = str_replace($markup, $markupsFemale[$index], $contract->contractText);
                }

            }
            else //use current markup when we don't have to choose between the different pronoun
            {
                switch ($markup){
                    case '{train_PrenomPersonne}':
                        $contract->contractText = str_replace($markup, $intern->firstname, $contract->contractText);
                        break;
                    case '{train_NomPersonne}':
                        $contract->contractText = str_replace($markup, $intern->lastname, $contract->contractText);
                        break;
                    case '{train_Adresse1}':
                        $contract->contractText = str_replace($markup, $intern->location->address1, $contract->contractText);
                        break;
                    case '{train_Adresse2}':
                        $contract->contractText = str_replace($markup, $intern->location->address2, $contract->contractText);
                        break;
                    case '{train_NPA}':
                        $contract->contractText = str_replace($markup, $intern->location->postalCode, $contract->contractText);
                        break;
                    case '{train_Localite}':
                        $contract->contractText = str_replace($markup, $intern->location->city, $contract->contractText);
                        break;
                    case '{corp_NomEntreprise}':
                        $contract->contractText = str_replace($markup, $company->companyName, $contract->contractText);
                        break;
                    case '{corp_Adresse1}':
                        $contract->contractText = str_replace($markup, $company->location->address1, $contract->contractText);
                        break;
                    case '{corp_Adresse2}':
                        $contract->contractText = str_replace($markup, $company->location->address2, $contract->contractText);
                        break;
                    case '{corp_NPA}':
                        $contract->contractText = str_replace($markup, $company->location->postalCode, $contract->contractText);
                        break;
                    case '{corp_Localite}':
                        $contract->contractText = str_replace($markup, $company->location->city, $contract->contractText);
                        break;
                    case '{Debut}':
                        $contract->contractText = str_replace($markup, date('d F Y', strtotime($contract->beginDate)), $contract->contractText);
                        break;
                    case '{Fin}':
                        $contract->contractText = str_replace($markup, date('d F Y', strtotime($contract->endDate)), $contract->contractText);
                        break;
                    case '{resp_PrenomPersonne}':
                        $contract->contractText = str_replace($markup, $responsible->firstname, $contract->contractText);
                        break;
                    case '{resp_NomPersonne}':
                        $contract->contractText = str_replace($markup, $responsible->lastname, $contract->contractText);
                        break;
                    case '{SalaireBrut}':
                        $contract->contractText = str_replace($markup, $internship->grossSalary, $contract->contractText);
                        break;
                    case '{date}':
                        $date = Carbon::now();
                        $contract->contractText = str_replace($markup, date('d F Y', strtotime($date)), $contract->contractText);
                        break;
                }
            }
        }

        return view('contract/contractVisualize')->with(['id' => $id, 'contract' => $contract]);
    }

    /**
     * Updates the data where the contract has been generated or create the pdf file
     *
     * @param $id of specific internship
     * @param Request $request contain post value, if we want make PDF or no
     * @return show the page of contract on format PDF or return to standart view of contract
     */
    public function saveContract($id, Request $request)
    {
        $date=date('Y-m-d H:i:s', strtotime(Carbon::now()));
        //update the contractGenerated field of Internship
        Internship::where("id",$id)->update(['contractGenerated' => $date ]);
        if ($request->pdf == 'pdf')
        {
            $pdf = App::make('dompdf.wrapper');             // Creates an "empty" pdf file
            $pdf->loadHTML($request->contractText);         // Inserts text into the file and converts markups into style
            return $pdf->stream("Contract-$id.pdf");   // Finalize pdf file, name it and send to download
        }
        return $this->generateContract($id);
    }

    /**
     * Deletes the date where the contract has been generated
     *
     * @param $id of internship
     * @return return to the page to update internship
     */
    public function cancelContract($id)
    {
        //update the contractGenerated field of Internship
        Internship::find($id)->update(['contractGenerated' => "0000-01-01 00:00:00"]);
        // Instantiate the internship controller to get back to the internship view
        $internshipController = new InternshipsController();
        return redirect()->route("internships.show", $id);
    }
}

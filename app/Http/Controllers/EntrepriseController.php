<?php
/**
 * Created by antonio.giordano
 * Date: 08.01.2018
 */

namespace App\Http\Controllers;

use App\Company;
use App\Internship;
use App\Remark;
use CPNVEnvironment\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EntrepriseController extends Controller
{

    /**
     * Display the company detail page, get all data needed and pass a message
     * @param $id
     * @param null $msg
     * @return $this
     */
    public function index($id, $msg=null){

        $user = Auth::user();

        $company = Company::findOrFail($id);

        $eType = DB::table('contracts')
            ->select('id', 'contractType')
            ->get();

        $contacts = DB::table('contactinfos')
            ->join('persons','persons.id','=','persons_id')
            ->select('contacttypes_id','value','firstname','lastname','persons.id as personId')
            ->where('company_id','=',$id)
            ->get();

        $iships = Internship::where('companies_id',$id)->get();

        $remarks = Remark::where('remarkType', 1)->where('remarkOn_id', $id)->orderby('remarkDate', "DESC")->get();

        return view('/entreprises/entreprise')->with(['company' => $company, 'user' => $user, 'contacts' => $contacts,  'iships'=>$iships, 'remarks'=>$remarks, 'message'=>$msg, 'contracts' => $eType]);
    }

    /**
     * Function saving the changes into database
     * @param Request $request (address1, address2, npa, city, ctype, location_id, engSkils, driverLicence, mptOk, website)
     * @param $id
     * @return $this
     */
    public function save(Request $request, $id){

        // Save the contract type first
        DB::table('companies')
            ->where('id',$id)
            ->update(['contracts_id' => $request->ctype, 'englishSkills' => $request->engSkils, 'driverLicence' => $request->driverLicence, 'mptOK' => $request->mptOk, 'website'=>$request->website]);

        // Get the actual location for checking if any change occur
        $actualLocation = DB::table('locations')
            ->select('address1','address2', 'postalCode', 'city')
            ->where('id',$request->location_id)
            ->get();

        // If location change, we need to contact the google API
        if ($actualLocation[0]->address1 != $request->address1  || $actualLocation[0]->address2 != $request->address2  || $actualLocation[0]->postalCode != $request->npa || $actualLocation[0]->city != $request->city)
        {
            $ok = $this->updateLocation($request); // Contact API with new data
            $error = is_string($ok); // If return a string, is an error message from the API

            if ($error == true) { // Return the error message
                return $this->index($id,$ok);
            }
            if ($ok){ // If no problem, return success message
                return $this->index($id,"Adresse retrouvée sur Google Maps, la carte est disponible");
            }
            else // If have a problem, update location lat lng with null and return error
            {
                DB::table('locations')
                    ->where('id',$request->location_id)
                    ->update(['address1' => $request->address1, 'address2' => $request->address2, 'postalCode' => $request->npa, 'city' => $request->city,'lat' => null, 'lng' => null]);
                return $this->index($id,"Adresse pas retrouvée sur Google Maps");
            }
        }
        else // Only contract type change, send success message
        {
            return $this->index($id, "Modifications enregistrées");
        }
    }

    /**
     * Contact the google maps API for calculate new latitude and longitude from the new address
     * @param $request (address1, address2, npa, city, ctype, location_id)
     * @return bool
     */
    public function updateLocation($request)
    {
        $ok = false;

        $adress1 = str_replace(" ", "+", $request->address1);
        $url = "https://maps.google.com/maps/api/geocode/json?address=$adress1,$request->npa,Suisse&sensor=false&key=" . $_ENV['API_GOOGLE_MAP'];
        $data = file_get_contents($url);
        $json = json_decode($data, true);
        $error = $this->checkGoogleAPI($json);


        if ($error != null) { // If have an error, return the message
            return $error;
        }

        if (isset($json["results"][0]["address_components"]))
            foreach ($json["results"][0]["address_components"] as $item)
                if ($item["types"][0] == "postal_code")
                    $GNPA = $item["long_name"];

        if (isset($GNPA) && ($request->npa == $GNPA)) // We find something on google
        {
            $lat = $json["results"][0]["geometry"]["location"]["lat"];
            $lng = $json["results"][0]["geometry"]["location"]["lng"];

            // Update location with new data
            DB::table('locations')
                ->where('id', $request->location_id)
                ->update(['address1' => $request->address1, 'address2' => $request->address2, 'postalCode' => $request->npa, 'city' => $request->city, 'lat' => $lat, 'lng' => $lng]);

            $ok = true;

        }
        else error_log("Update location from googleMaps failed.\nRequest: $url\nResponse: $data");

        return $ok;
    }


    /**
     * Function for checking if the api return an error message, if yes return it or return null
     * @param $data (JSON)
     * @return null
     */
    public function checkGoogleAPI($data){
        if(isset($data[count($data)-1]["error_message"])) {
            return $data[count($data)-1]["error_message"];
        }
        return null;
    }

    public function remove($id){
        // Function for delete companies from the list, need to implement Eloquent for soft deleting
    }
}

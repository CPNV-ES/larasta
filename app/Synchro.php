<?php

/*
 * I was initially gonna use a package called nimbly, but after some testing, it seemed like it wasn't working or I didn't understabd the intranet API enough
 * So I just decided to take the JSON file directly from the intranet with a cURL function and a simple json_decode() which seems to work pretty well
 * Issue is that we have to put credentials or it won't work, which could be an issue depending on what we can do or not
 * 
*/

namespace App;

//use ActiveResource\Model;


class Synchro
{
    /*protected function parseFind($payload)
    {
        return $payload->corporate_email;
    }

    protected function parseAll($payload){
        return $payload;
    }*/
    private $jsonResponse;

    public function __construct()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://intranet.cpnv.ch/info/etudiants.json?alter%5Bextra%5D=current_class",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_USERPWD => env('API_USERPWD', false),
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
        ));

        $response = curl_exec($curl);
        $this->jsonResponse = json_decode($response, true);
        $err = curl_error($curl);

        curl_close($curl);
    }

    public function getJsonResponse()
    {
        return $this->jsonResponse;
    }
}

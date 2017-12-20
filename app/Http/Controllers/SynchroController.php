<?php
/*
 * Title : SynchroController.php
 * Author : Steven Avelino
 * Creation Date : 12 December 2017
 * Modification Date : 16 December 2017
 * Version : 0.1
 * Controller for the Synchronisation between the intranet API and this application
*/

namespace App\Http\Controllers;

use App\Synchro;
/*use ActiveResource\Connection;
use ActiveResource\ConnectionManager;
use Illuminate\Http\Request;*/

class SynchroController extends Controller
{
    /*public function connectionAPI()
    {
        $options = [
            Connection::OPTION_BASE_URI => 'http://intranet.cpnv.ch/info/etudiants.json?alter%5Bextra%5D=current_class',
            Connection::OPTION_DEFAULT_HEADERS => [
                'demo' => 'secret',
            ]
        ];
        
        $connection = new Connection($options);
    
        ConnectionManager::add('default', $connection);
    }*/

    public function index()
    {
        $synchroObject = new Synchro;
        $jsonResponse = $synchroObject->getJsonResponse();

        return view('synchro/index')->with([ 'jsonResponse' => $jsonResponse ]);
    }
}
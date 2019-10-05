<?php

/*
 * Title: VisitsController.php
 * Author: Jean-Yves Le
 * Creation date : 12 Dec 2017
 * Modification date : 23 Jan 2018
 * Version : 0.8
 *
*/

namespace App\Http\Controllers;

// Requests
use Illuminate\Http\Request;

//Models
use App\Visit;
use App\Internship;
use App\Remark;
use App\Evaluation;
use App\Persons;
use App\Visitsstate;

// Intranet env
use CPNVEnvironment\Environment;

// Other
use Illuminate\Support\Facades\DB;
use DateTime;

/*
 * VisitsController
 *
 * Provides the methods to list, edit visits
 *
 * */
class VisitsController extends Controller
{
    /* Initialize global variable(s) */
    private $message = '';

    /*
     * -- index --
     *
     * In main page of visits
     * - Return a list of visit from Teacher ID
     * - It just displays his/her visits.
     * */
    public function index()
    {
        /* Initialize id to check user ID in "Query get visits"->line 77 */
        $id = Environment::currentUser()->getId();

        // Check if the user is a teacher or superuser. We grant him/her access to visits if he has access
        // Student = 0; Teacher = 1; Admin = 2
        if (Environment::currentUser()->getLevel() >= 1){

            //Eloquent query gets all the visits for the current internships  from teacher ID 
            $visits=Visit::whereHas('internship.student.flock',function($query) use ($id){
                $query->where('classMaster_id',$id)->where('beginDate','<=',now())->where('endDate','>',now());
            })->get();

            // Returns all details to his/her in visits' main page
            return view('visits/visits')->with(
                [
                    'visits' => $visits,
                    'message' => $this->message
                ]
            );
        }

        //If not teacher or superuser, we redirect him/her to home page
        else
        {
            return redirect('/')->with('status', "You don't have the permission to access this function.");
        }
    }

    /*
     * -- manage --
     *
     * It returns data from a visit that user has selected.
     *
     * */
    public function manage ($rid) {

        // Check if the user is a teacher or superuser. We grant him/her access to visits if he has access
        // Student = 0; Teacher = 1; Admin = 2
        if (Environment::currentUser()->getLevel() >= 1){

            // Try to know if a visit exist
            $visits=Visit::find($rid)
            ->get();

            // If the visit doesn't exist in the DB. by typing the ID the the URL bar.
            // return the user to his/her of visit
            foreach($visits as $visit){
                if(isset($visit->id) == 1)
                {

                    // Gets info from intern's responsible
                    $mails = $visit->internship->responsible->contactinfo->where('contacttypes_id','1');

                    // Gets info from intern's responsible
                    $locals = $visit->internship->responsible->contactinfo->where('contacttypes_id','2');

                    // Gets info from intern's responsible
                    $mobiles = $visit->internship->responsible->contactinfo->where('contacttypes_id','3');
 
                    /*
                     * Get status name of visit for the select input.
                     * It musts be under 3, which means that the visit has to be closed by an "Evaluation".
                     * statusName
                     * 1. En préparation
                     * 2. Confirmée
                     * 3. Effectuée
                     *  */
                    $visitstate = Visitsstate::get();
                    /*
                     * Gets remarks about the visit
                     * It returns all remarks about the visit by its ID.
                     * 1. Date
                     * 2. Author
                     * 3. remark(s)
                     * */
                    $history = Remark::where('remarkOn_id', "=", $rid)->orderby('remarkDate', "DESC")->get(); 
                    
                    /* $history = Remark::select("remarkType", "remarkDate", "remarkText", "remarkOn_id", "author")
                        ->where('remarkOn_id', "=", $rid)
                        ->orderby('remarkDate', "DESC")
                        ->get(); */
                    /*
                     * Gets evaluation from the visit (ID).
                     * */
                    $eval = $visit->evaluation->first();

                    return view('visits/manage')->with(
                        [
                            'visit' => $visit,
                            'mails' => $mails,
                            'locals' => $locals,
                            'mobiles' => $mobiles,
                            'visitstate' => $visitstate,
                            'history' => $history,
                            'eval' => $eval
                        ]
                    );
                }
            
                //If it's not a teacher or superuser, we redirect him/her to visits' main page.
                else
                {
                    return redirect('/visits')->with('status', "Visite pas trouvée");
                }
            }
        }

        //If not teacher or superuser, we redirect him/her to home page
        else
        {
            return redirect('/')->with('status', "You don't have the permission to access this function.");
        }
    }

    /*
     * -- mail --
     *
     * Updating visit's status and insert a remark that the visit has been updated.
     * */
    public function mail($id)
    {
        // Check if the user is a teacher or superuser. We grant him/her access to visits if he has access
        // Student = 0; Teacher = 1; Admin = 2
        if (Environment::currentUser()->getLevel() >= 1){
            /*
             * Query Update that updates mail & visit status
             * */
            Visit::where('visits.id', '=', $id)
                ->update([
                    'visitsstates_id' => 2,
                    'mailstate' => 1
                ]);

            /* Initialize current datetime */
            $date = new DateTime();

            /*
             * Add a remark (history) and specify the type, date and the description of this remark.
             * */
            Remark::insert([
                'remarkType' => 4,
                'remarkOn_id' => $id,
                'remarkDate' => $date->format('Y-m-d H:i:s'),
                'author' => Environment::currentUser()->getInitials(),
                'remarkText' => "Email envoyé au responsable à ".$date->format('d M Y')." à ".$date->format('H:i:s')
            ]);

            /*
             * Redirect the user the his/her visits' list.
             * */
            return redirect('/visits')->with('status', 'Etat de la visite a été modifié !');
        }

        //If not teacher or superuser, we redirect him/her to home page
        else
        {
            return redirect('/')->with('status', "You don't have the permission to access this function.");
        }
    }

    /*
     * -- delete --
     *
     * This method allows the user to delete the visit
     *
     * */
    public function delete($id)
    {
        // Check if the user is a teacher or superuser. We grant him/her access to visits if he has access
        // Student = 0; Teacher = 1; Admin = 2
        if (Environment::currentUser()->getLevel() >= 1){

            /*
             * delete row by visit's current ID
             * */
            Visit::where('id', '=', $id)
                ->delete();

            return redirect('/visits')->with('status', 'Visite supprimée !');
        }

        //If not teacher or superuser, we redirect him/her to home page
        else
        {
            return redirect('/')->with('status', "You don't have the permission to access this function.");
        }
    }

    /*
     * -- update --
     *
     * The Method update allow the user to update visit
     *
     * */
    public function update(Request $request, $id)
    {
        if (Environment::currentUser()->getLevel() >= 1){

            /*
             * Initialize variables to update the visit
             * 1. State of the visit
             * 2. Date
             * 3. Time
             * 4. State of the mail
             * */
            $state = $request->input('state');
            $date = $request->upddate;
            $date .= " ".$request->updtime;
            $mail = $request->has('checkm');

            /*
             * Update visit from values above.
             * */
            Visit::where('visits.id', '=', $id)
                ->update([
                    'visitsstates_id' => $state,
                    'moment' => $date,
                    'mailstate' => $mail,
                ]);

            /*
             * capture datetime from input.
             * */
            $date = date('d M Y', strtotime($request->upddate));
            $hour = date('H:i:s', strtotime($request->updtime));

            /*
             * Insert new remark row as a log in Remark.
             * */
            Remark::insert([
                'remarkType' => 4,
                'remarkOn_id' => $id,
                'remarkDate' => date('Y-m-d H:i:s'),
                'author' => Environment::currentUser()->getInitials(),
                'remarkText' => "Date fixée: ".$date." à ".$hour
            ]);

            /*
             * Finally it redirects user to his/her list.
             * */
            return redirect('/visits')->with('status', 'La visite a été modifiée !');
        }

        //If not teacher or superuser, we redirect him/her to home page
        else
        {
            return redirect('/')->with('status', "You don't have the permission to access this function.");
        }
    }

}
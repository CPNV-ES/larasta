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
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\VisitRequest;

//Models
use App\Visit;
use App\Remark;
use App\Person;
use App\Visitsstate;
use App\EvaluationSection;

// Intranet env
use CPNVEnvironment\Environment;

// Other
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
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
        $id = Auth::user()->id;
        // Check if the user is a teacher or superuser. We grant him/her access to visits if he has access
        // Student = 0; Teacher = 1; Admin = 2
        if (Auth::user()->role >= 1){
            //Eloquent query gets all the visits from teacher ID that are in the past
            $visitsToCome = Visit::whereHas('internship.student.flock',function($query) use ($id)
            {
                $query->where('classMaster_id',$id)->where('moment','>',now()->toDateTimeString()); 
            })->get();
            //Eloquent query gets all the visits from teacher ID that are in the future
            $visitsPast = Visit::whereHas('internship.student.flock',function($query) use ($id){
                $query->where('classMaster_id',$id)->where('moment','<=', now()->toDateTimeString());
            })->get();
            $person = Person::whereHas('mcof')->get();
            // Returns all details to his/her in visits' main page
            return view('visits/visits')->with(
                [
                    'id' => $id,
                    'persons' => $person,
                    'visitsPast' => $visitsPast,
                    'visitsToCome' => $visitsToCome,
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

    public function filter(Request $request){
    
        $id = $request->input('teacher');
        if (Auth::user()->role >= 1){

            //Eloquent query gets all the visits from teacher ID that are in the past
            $visitsToCome = Visit::whereHas('internship.student.flock',function($query) use ($id){
                $query->where('classMaster_id',$id)->where('moment','>',now()); })->get();
                //Eloquent query gets all the visits from teacher ID that are in the future
            $visitsPast = Visit::whereHas('internship.student.flock',function($query) use ($id){
                $query->where('classMaster_id',$id)->where('moment','<=',now());})->get();
            //Eloquent query to gets all the teacher
            $person = Person::whereHas('mcof')->get(); 
            // Returns all details to his/her in visits' main page
            return view('visits/visits')->with(
                [
                    'id' => $id,
                    'persons' => $person,
                    'visitsPast' => $visitsPast,
                    'visitsToCome' => $visitsToCome,
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

        $studentToVisit = Visit::find($rid)->internship->student->id;

        // Check if the user is a teacher or superuser. We grant him/her access to visits if he has access
        // Or the concerned student of the internship
        // Student = 0; Teacher = 1; Admin = 2
        if (Auth::user()->role >= 1 || Auth::user()->id == $studentToVisit){

            // Try to know if a visit exist
            $visit = Visit::find($rid);
            // If the visit doesn't exist in the DB. by typing the ID the the URL bar.
            // return the user to his/her of visit
                if(isset($visit->id) == 1)
                {
                    $student = $visit->internship->student->humanContactInfo();
                    $classMaster = $visit->internship->student->flock->classMaster->fullname;
                    $responsible = $visit->internship->responsible->humanContactInfo();
                    $admin = $visit->internship->admin->humanContactInfo();
 
                    /*
                     * Get status name of visit for the select input.
                     * It musts be under 3, which means that the visit has to be closed by an "Evaluation".
                     * statusName
                     * 1. En préparation
                     * 2. Confirmée
                     * 3. Effectuée
                     *  */
                    $visitstates = Visitsstate::get();
                    $visitActualStateId = $visit->visitsstates_id;

                    /*
                     * Gets remarks about the visit
                     * It returns all remarks about the visit by its ID.
                     * 1. Date
                     * 2. Author
                     * 3. remark(s)
                     * */
                    $remarks = Remark::where('remarkOn_id', $rid)->where('remarkType', 4)->orderby('remarkDate', "DESC")->get();

                    /*
                     * Gets media associate from the visit (ID).
                     * */
                    $medias = $visit->getMedia();
                    return view('visits/manage')->with(
                        [
                            'visit' => $visit,
                            'student' => $student,
                            'classMaster' => $classMaster,
                            'responsible' => $responsible,
                            'admin' => $admin,
                            'visitActualStateId' => $visitActualStateId,
                            'visitstates' => $visitstates,
                            'remarks' => $remarks,
                            'medias' => $medias
                        ]
                    );
                }
            
                //If it's not a teacher or superuser, we redirect him/her to visits' main page.
                else
                {
                    return redirect('/visits')->with('status', "Visite pas trouvée");
                }
        }

        //If not teacher or superuser, we redirect him/her to home page
        else
        {
            return redirect('/')->with('status', "You don't have the permission to access this function.");
        }
    }


    public function evaluation($visitId){  
        $visit = Visit::find($visitId);
        $concernedStudent = $visit->internship->student->id;
        
        if (Auth::user()->id == $concernedStudent && $visit ->visitsstates_id == 2){
    
            $evaluationSections = EvaluationSection::all();
            $company = $visit->internship->company->companyName;
            $classMaster = $visit->internship->student->flock->classMaster->fullname;
            $responsible = $visit->internship->responsible->humanContactInfo();

            return view('visits/evaluationGrid')->with(
                [   
                    'evaluationSections' => $evaluationSections,
                    'visit' => $visit
                ]
            );

        }else{
            return redirect(route('visit.manage', $visitId))->with('status',  "You don't have the permission to access this function.");
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
        if (Auth::user()->role >= 1){
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
                'author' => Auth::user()->initials,
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
        if (Auth::user()->role >= 1){

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
        if (Auth::user()->role >= 1){

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
            $note = $request->grade;

            if(empty($note)) {
                if($state == Visitsstate::where('slug', 'bou')->first()->id) {
                    return redirect()->route('visit.manage', ['rid'=>$id])
                        ->with('status', "Vous ne pouvez pas passer la visite en 'Bouclée' si aucune note n'est entrée !");
                }
            }
            else {
                if($state == Visitsstate::where('slug', 'pro')->first()->id || $state == Visitsstate::where('slug', 'acc')->first()->id) {
                    return redirect()->route('visit.manage', ['rid'=>$id])
                        ->with('status', "Vous ne pouvez pas passer la visite en 'Proposée' ou 'Acceptée' si une note est entrée !");
                }
            }

            /*
             * Update visit from values above.
             * */
            Visit::where('visits.id', '=', $id)
                ->update([
                    'visitsstates_id' => $state,
                    'moment' => $date,
                    'grade' => $note
                ]);

            /*
             * capture datetime from input.
             * */
            $date = date('d M Y', strtotime($request->upddate));
            $hour = date('H:i:s', strtotime($request->updtime));

            /*
             * Finally it redirects user to his/her list.
             * */
            return redirect(route('visit.manage', $id))->with('status', 'La visite a été modifiée !');
        }

        //If not teacher or superuser, we redirect him/her to home page
        else
        {
            return redirect('/')->with('status', "You don't have the permission to access this function.");
        }
    }


    public function sendMail(Request $request, $id){

        if (Auth::user()->role >= 1){

            $maildate = date("Y-m-d");

            Visit::where('visits.id', '=', $id)
            ->update([
                'mailstate' => "1",
                'maildate' => $maildate
            ]);
            

            return redirect(route('visit.manage', $id));

        }else{
            return redirect('/')->with('status', "You don't have the permission to access this function.");
        }
    }

    public function storeFile(StoreFileRequest $request, $id)
    {
        $visit = Visit::find($id);
        $visit->addMediaFromRequest('file')->toMediaCollection();
    }
    public function deleteFile($id,$idMedia)
    {
        $visit = Visit::find($id);
        $visit->getMedia()->find($idMedia)->delete();
    }
    
    public function store($id,VisitRequest $request)
    {
        $visit = new Visit;
        $request->confirmed ? $confirmed = true : $confirmed = false;
        $request->mailstate ? $mailstate = true : $mailstate = false;
        $visit->moment = date('Y-m-d H:i:s', strtotime("$request->day $request->hour"));

        $visit->fill($request->all());
        $visit->confirmed = $confirmed;
        $visit->mailstate = $mailstate;
        $visit->internships_id = $id;    
        $visit->save();

        return redirect()->back();
    }
    
    public function updateVisit($id, VisitRequest $request)
    {
        if (Auth::user()->role < 2) 
            abort(404);
            
        $visit = Visit::findOrFail($request->id);

        $request->confirmed ? $confirmed = true : $confirmed = false;
        $request->mailstate ? $mailstate = true : $mailstate = false;
        $visit->moment = date('Y-m-d H:i:s', strtotime("$request->day $request->hour"));
        
        $visit->fill($request->all());
        $visit->confirmed = $confirmed;
        $visit->mailstate = $mailstate;
        $visit->internships_id = $id;   

        $visit->save();
    }
}
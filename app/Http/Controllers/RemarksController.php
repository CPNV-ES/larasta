<?php

namespace App\Http\Controllers;

use App\Remark;
use CPNVEnvironment\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemarksController extends Controller
{
    private $message; // a message to display - if defined - in views

    /**
     * addRemark allows to enter a remark on something. The timestamp put on it is the current time and the person is the current user
     *
     * @param $type which kind of entity is subject to the remark. Refer to database field comments for exact values
     * @param $on the id of the record in its table
     * @param $text the content of the reamrk. No checks are performed, Eloquent does it for us
     */
    public static function addRemark($type, $on, $text)
    {
        $n = new Remark();
        $n->remarkType = $type;
        $n->remarkOn_id = $on;
        $n->remarkDate = date('Y-m-d H:i:s');
        $n->remarkText = $text;
        $n->author = Auth::user()->person->initials;
        $n->save();
    }

    public function index()
    {
        $remarks = Remark::all();
        return view('remarks/remarks')->with(
            [
                'remarks' => $remarks,
                'message' => $this->message
            ]
        );
    }

    public function filter(Request $request)
    {
        $needle = $request->needle;
        $remarks = Remark::where('remarkText','like',"%$needle%")->get();
        return view('remarks/remarks')->with(
            ['remarks' => $remarks]
        );
    }

    public function ajaxCreate(Request $request) {
        self::addRemark($request->type,$request->on,$request->text);
        return 'Remarque ajoutée';
    }

    public function create(Request $request) {
        self::addRemark(1,1,$request->newremtext);
        $request->session()->flash('status', 'Remarque ajoutée');
        return redirect('/remarks');
    }

    public function edit (Request $request, $rid) {
        $remark = Remark::where('id',$rid)->first();
        return view('remarks/remark')->with(
            [
                'remark' => $remark,
                'message' => $this->message
            ]
        );
    }

    public function delete (Request $request) {
        $remark = Remark::where('id',$request->delid)->first();
        $remark->delete();
        $this->message = 'Remarque supprimée';
        return $this->index();
    }

    public function update (Request $request) {
        $remark = Remark::where('id',$request->updid)->first();
        $remark->remarkText = $request->updtext;
        $remark->save();
        $request->session()->flash('status', 'Remarque modifiée');
        return redirect('/remarks');
    }
}

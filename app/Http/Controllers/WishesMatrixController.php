<?php

namespace App\Http\Controllers;

use App\Flock;
use App\Internship;
use App\Person;
use App\Params;

use App\Remark;
use App\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\json_encode;

use CPNVEnvironment\Environment;


class WishesMatrixController extends Controller
{
    /**
     * Display the wish page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View : wish page
     */
    public function index()
    {
        // !!!!!!!!!!!! Test Value !!!!!!!!!!!!!!!!!!!!!!!!!!
        $currentUserId = Auth::user()->person->id;
        $currentUser = Person::find($currentUserId);
        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        // List of all possible parent internships, having an internship starting this year
        // For testing : date('Y') - 1
        $parentInternships = Internship::whereYear('beginDate', '=', date('Y') - 1)
            ->whereNull('parent_id')
            ->get()
            ->sortBy(function ($internship) {
                return $internship->company->companyName;
            });

        // list of all non attributed internships, starting this year, having the contract state Confirmé or Reconduit
        // For testing : date('Y') - 1
        $internshipsToDisplay = Internship::whereYear('beginDate', '=', date('Y') - 1)
            ->whereHas('contractstate', function ($query) {
                $query->where('stateDescription', 'Confirmé')
                    ->orWhere('stateDescription', 'Reconduit');
            })
            ->whereNull('intern_id')
            ->get();

        // parent internship id => count of non attributed internships in its group
        $placesQuantities = array();
        // Initialize the count to 0
        foreach ($parentInternships as $parentInternship) {
            $placesQuantities[$parentInternship->id] = 0;
        }

        // parent internship id => one non attributed child id
        $childIds = array();

        // Compute the count, and get the child id to display
        foreach ($internshipsToDisplay as $internshipToDisplay) {
            // internships with a null parent_id are their own parent
            $parentInternshipId = is_null($internshipToDisplay->parent_id) ?
                $internshipToDisplay->id : $internshipToDisplay->parent_id;

            // increment the parent count
            $placesQuantities[$parentInternshipId] += 1;

            // update the child id
            $childIds[$parentInternshipId] = $internshipToDisplay->id;
        }

        // Get the selected year, and all classes from that year
        $selectedFlockYear = Params::getParamByName('wishesSelectedYear');
        // Create param if it does not exist
        if (is_null($selectedFlockYear)) {
            $param = new Params();
            $param->paramName = 'wishesSelectedYear';
            $param->paramValueInt = -1;
            $param->save();
            $selectedFlockYear = $param;
        }

        $flocks = null;
        if ($selectedFlockYear != null) {
            $selectedFlockYear = $selectedFlockYear->paramValueInt;
            $flocks = $this->getFlocksWithYear($selectedFlockYear);
        }

        // Get info for teacher : available start years, and date of end for wishes
        $flockYears = null;
        $dateEndWishes = null;
        // Test if current user is a teacher
        if ($currentUser->isTeacher) {
            // get date end wishes
            $param = Params::getParamByName('dateEndWishes');
            if ($param != null) {
                // Convert the date/time to date only
                $dateEndWishes = date('Y-m-d', strtotime($param->paramValueDate));
            }

            // get flock years
            $flockYears = $this->getFlockYears();
        }

        return view('wishesMatrix/wishesMatrix')
            ->with([
                'parentInternships' => $parentInternships,
                'placesQuantities' => $placesQuantities,
                'childIds' => $childIds,
                'currentUser' => $currentUser,
                'dateEndWishes' => $dateEndWishes,
                'selectedYear' => $selectedFlockYear,
                'flocks' => $flocks,
                'flockYears' => $flockYears
            ]);
    }


    /**
     * Save the display modifications of the wishMatrix page
     *
     * @param Request $request : POST request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector : redirect to the wish page
     */
    public function save(Request $request)
    {
        // validate the data
        $data = $request->validate([
            'dateEndWishes' => 'date|nullable',
            'flockYear' => 'digits:2',
        ]);


        // Do only if user is not student
        if (Auth::user()->role > 0) {
            // Save the date
            if (isset($data['dateEndWishes'])) {
                // get the date saved in the database
                $param = Params::getParamByName('dateEndWishes');

                // Create param if it does not exist
                if (is_null($param)) {
                    $param = new Params();
                    $param->paramName = 'dateEndWishes';
                }

                // Update the date
                $param->paramValueDate = $data['dateEndWishes'];
                $param->save();
            }

            // Save the year to display
            if (isset($data['flockYear'])) {
                // get the year saved in the database
                $param = Params::getParamByName('wishesSelectedYear');

                // Create param if it does not exist
                if (is_null($param)) {
                    $param = new Params();
                    $param->paramName = 'wishesSelectedYear';
                }

                // update the year
                $param->paramValueInt = $data['flockYear'];
                $param->save();
            }
        }

        // return to the wishMatrix view
        return redirect('/wishesMatrix');
    }

    /**
     * Save the display wishes of a student
     *
     * @param Request $request : POST request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveWishes(Request $request)
    {
        $currentUser = Auth::user()->person;

        // Only students should be able to save their wishes
        if (Auth::user()->role != 0) {
            return redirect('/wishesMatrix');
        }

        $studentId = $currentUser->getId();
        $student = Person::find($studentId);

        // validate the data
        $data = $request->validate([
            'choices' => 'required|json',
        ]);

        // extract data
        $wishesCollection = json_decode($data['choices'])->wishes;

        // convert the wishes to a map : internship_id => rank
        $wishes = [];
        foreach ($wishesCollection as $wish) {
            $wishes[$wish->internship_id] = $wish->rank;
        }

        $logText = "Modification des souhaits :";
        foreach ($wishes as $internship_id => $rank) {
            $internship = Internship::find($internship_id);
            $logText = $logText . " {$internship->company->companyName}({$rank}),";
        }
        $logText = substr($logText, 0, -1);

        $remark = new Remark();
        $remark->remarktype = 2;
        $remark->remarkOn_id = $student->id;
        $remark->author = $student->initials;
        $remark->remarkText = $logText;
        $remark->save();

        // get old wishes of the student
        $oldWishes = $student->wishes->all();

        foreach ($oldWishes as $oldWish) {
            $internshipId = $oldWish->internship->id;

            // if the new wish is already in the old wishes, or if the old wish is approved
            if (array_key_exists($internshipId, $wishes) || $oldWish->application > 0) {
                $wishRank = array_key_exists($internshipId, $wishes) ? $wishes[$internshipId] : 0;

                // if the wish rank is different, update the rank
                $oldrank = $oldWish->rank;
                if ($wishRank != $oldrank) {
                    $oldWish->rank = $wishRank;
                    $oldWish->save();

                    $remark = new Remark();
                    $remark->remarktype = 5;
                    $remark->remarkOn_id = $internshipId;
                    $remark->author = $student->initials;
                    $remark->remarkText =
                        "Modification du rang du souhait de {$student->firstname} {$student->lastname}, de {$oldrank} à {$wishRank}";
                    $remark->save();
                }

                // remove the wish from the wishes list
                unset($wishes[$internshipId]);

            } else {
                $oldWish->delete();

                $remark = new Remark();
                $remark->remarktype = 5;
                $remark->remarkOn_id = $internshipId;
                $remark->author = $student->initials;
                $remark->remarkText =
                    "Suppression du souhait de {$student->firstname} {$student->lastname}";
                $remark->save();
            }
        }

        // new wishes
        foreach ($wishes as $internshipId => $rank) {
            $wish = new Wish();
            $wish->internships_id = $internshipId;
            $wish->persons_id = $studentId;
            $wish->rank = $rank;
            $wish->save();

            $remark = new Remark();
            $remark->remarktype = 5;
            $remark->remarkOn_id = $internshipId;
            $remark->author = $student->initials;
            $remark->remarkText =
                "Ajout d'un souhait de {$student->firstname} {$student->lastname}";
            $remark->save();
        }

        // return to the wishMatrix view
        return redirect('/wishesMatrix');
    }

    public function saveWishesPostulations(Request $request)
    {
        $currentUser = Auth::user()->person;

        // Only teachers should be allowed modify postulations
        if (Auth::user()->role <= 0) {
            return redirect('/wishesMatrix');
        }

        // validate the data
        $data = $request->validate([
            'postulations' => 'required|json',
        ]);

        // extract data
        $postulationsCollection = json_decode($data['postulations'])->postulations;

        $teacher = Person::find($currentUser->getId());

        // existing wishes : convert the postulations to a map : wishId => isValidated
        // new wishes : create the new wish
        $postulations = [];
        foreach ($postulationsCollection as $postulation) {
            if ($postulation->wishId != "") {
                $postulations[$postulation->wishId] = $postulation->isValidated;
            } else {
                if ($postulation->isValidated) {
                    $wish = new Wish();
                    $wish->internships_id = $postulation->internshipId;
                    $wish->persons_id = $postulation->studentId;
                    $wish->rank = 0;
                    $wish->application = 1;
                    $wish->save();

                    $student = Person::find($postulation->studentId);
                    $internship = Internship::find($postulation->internshipId);

                    // Teacher log
                    $teacherRemark = new Remark();
                    $teacherRemark->remarkType = 2;
                    $teacherRemark->remarkOn_Id = $teacher->id;
                    $teacherRemark->author = $teacher->initials;
                    $teacherRemark->remarkText =
                        "Ajout d'une postulation de {$student->firstname} {$student->lastname} chez {$internship->company->companyName}";
                    $teacherRemark->save();

                    // Student log
                    $studentRemark = new Remark();
                    $studentRemark->remarkType = 2;
                    $studentRemark->remarkOn_Id = $student->id;
                    $studentRemark->author = $teacher->initials;
                    $studentRemark->remarkText =
                        "Ajout d'une postulation chez {$internship->company->companyName} par {$teacher->firstname} {$teacher->lastname}";
                    $studentRemark->save();

                    // Internship log
                    $internshipRemark = new Remark();
                    $internshipRemark->remarkType = 1;
                    $internshipRemark->remarkOn_Id = $internship->company->id;
                    $internshipRemark->author = $teacher->initials;
                    $internshipRemark->remarkText =
                        "Ajout d'une postulation de {$student->firstname} {$student->lastname} par {$teacher->firstname} {$teacher->lastname}";
                    $internshipRemark->save();
                }
            }
        }

        foreach ($postulations as $wishId => $isValidated) {
            $wish = Wish::find($wishId);

            // wish->application <= 0 : no postulation
            // wish->application > 0 : postulation
            $wasValidated = ($wish->application > 0);

            if ($wasValidated !== $isValidated) {
                $wish->application = (int)$isValidated;
                $wish->save();

                $student = $wish->person;
                $internship = $wish->internship;

                // Teacher log
                $teacherRemark = new Remark();
                $teacherRemark->remarkType = 2;
                $teacherRemark->remarkOn_Id = $teacher->id;
                $teacherRemark->author = $teacher->initials;
                $teacherRemarkText = "";
                if ($isValidated) {
                    $teacherRemarkText =
                        "Approbation de la postulation de {$student->firstname} {$student->lastname} chez {$internship->company->companyName}";
                } else {
                    $teacherRemarkText =
                        "Retrait de l'approbation de la postulation de {$student->firstname} {$student->lastname} chez {$internship->company->companyName}";
                }
                $teacherRemark->remarkText = $teacherRemarkText;
                $teacherRemark->save();

                // Student log
                $studentRemark = new Remark();
                $studentRemark->remarkType = 2;
                $studentRemark->remarkOn_Id = $student->id;
                $studentRemark->author = $teacher->initials;
                $studentRemarkText = "";
                if ($isValidated) {
                    $studentRemarkText =
                        "Approbation de la postulation chez {$internship->company->companyName} par {$teacher->firstname} {$teacher->lastname}";
                } else {
                    $studentRemarkText =
                        "Retrait de l'approbation de la postulation chez {$internship->company->companyName} par {$teacher->firstname} {$teacher->lastname}";
                }
                $studentRemark->remarkText = $studentRemarkText;
                $studentRemark->save();

                // Internship log
                $internshipRemark = new Remark();
                $internshipRemark->remarkType = 1;
                $internshipRemark->remarkOn_Id = $internship->company->id;
                $internshipRemark->author = $teacher->initials;
                $internshipRemarkText = "";
                if ($isValidated) {
                    $internshipRemarkText =
                        "Approbation de la postulation de {$student->firstname} {$student->lastname} par {$teacher->firstname} {$teacher->lastname}";
                } else {
                    $internshipRemarkText =
                        "Retrait de l'approbation de la postulation de {$student->firstname} {$student->lastname} par {$teacher->firstname} {$teacher->lastname}";
                }
                $internshipRemark->remarkText = $internshipRemarkText;
                $internshipRemark->save();
            }
        }

        // return to the wishMatrix view
        return redirect('/wishesMatrix');
    }

    /**
     * Get all distinct start years of flocks, starting by the latest
     *
     * @return array : starting years of flocks
     */
    private function getFlockYears()
    {
        $flockYears = Flock::distinct()
            ->orderBy('startYear', 'desc')
            ->pluck('startYear');
        return $flockYears;
    }

    /**
     * Get all flocks that started on a specific year, ordered alphabetically
     *
     * @param $year : starting year of the flocks
     * @return mixed : list of flocks
     */
    private function getFlocksWithYear($year)
    {
        $flocks = Flock::where('startYear', '=', $year)
            ->orderBy('flockName')
            ->get();
        return $flocks;
    }
}

<?php

namespace App\Http\Controllers\MoraleSurvey;

use DB;
use Webpatser\Uuid\Uuid;
use App\Models\MoraleSurvey\MorssSurvey;
use App\Models\MoraleSurvey\MorssQuestion;
use App\Models\MoraleSurvey\MorssSemester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = MorssSemester::with(['moraleSurveys' => function ($query) {
            $query->selectRaw('COUNT(DISTINCT user_id) AS \'total\'')->first();
        }])->latest()->get();

        $query = MorssSurvey::selectRaw('
                                COUNT(DISTINCT user_id) AS \'total\'
                            ')->first();

        $query2 = MorssSemester::join('morss_surveys','morss_surveys.semester_id','=','morss_semesters.id')->get();
        
        // return view('moralesurvey.semester.index', compact('semesters'));
        // return $query;
        return $query2;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = MorssQuestion::all();
        return view('moralesurvey.semester.create-modal', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $semester = new MorssSemester;
        $semester->uuid       = (string) Uuid::generate(4);
        $semester->month_from = $request->month_from .'-01';
        $semester->month_to   = $request->month_to .'-01';
        $semester->status     = $request->status;
        $semester->questions  = $request->question_id;
        $semester->save();

        return redirect()->route('semester.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $semester  = MorssSemester::find($id);
        $questions = MorssQuestion::whereIn('id', $semester->questions)->get();
        return view('moralesurvey.semester.show-modal', compact('semester', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

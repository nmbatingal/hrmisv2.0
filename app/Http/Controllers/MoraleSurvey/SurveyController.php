<?php

namespace App\Http\Controllers\MoraleSurvey;

use Auth;
use App\User;
use App\Models\MoraleSurvey\MorssSurvey;
use App\Models\MoraleSurvey\MorssSemester;
use App\Models\MoraleSurvey\MorssQuestion;
use App\Models\MoraleSurvey\MorssSurveyRemark;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = MorssSemester::nowSurvey()->get();

        $user      = User::where('id', Auth::user()->id)->with('moraleSurveys')->first();

        return view('moralesurvey.survey.index', compact('semesters', 'user'));
        // return $user->moraleSurveys;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function survey($uuid)
    {
        $survey    = MorssSemester::where('uuid', $uuid)->active()->first();
        $questions = MorssQuestion::whereIn('id', $survey->questions)->get();
        return view('moralesurvey.survey.survey-form', compact('survey', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->question_id as $id) {

            $survey = new MorssSurvey;
            $survey->semester_id  = $request->sem_id;
            $survey->user_id      = Auth::user()->id;
            $survey->question_id  = $id;
            $survey->rate         = $request['qn_'.$id];
            $survey->save();

        }

        $remarks = new MorssSurveyRemark;
        $remarks->semester_id  = $request->sem_id;
        $remarks->user_id      = Auth::user()->id;
        $remarks->remarks      = nl2br($request->remarks);
        $remarks->save();

        return dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

<?php

namespace App\Http\Controllers\MoraleSurvey;

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
        $semesters = MorssSemester::latest()->get();
        $questions = MorssQuestion::all();
        return view('moralesurvey.semester.index', compact('semesters', 'questions'));
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

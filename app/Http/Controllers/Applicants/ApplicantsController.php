<?php

namespace App\Http\Controllers\Applicants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Applicants\ApplicantsInfo as Applicant;
use App\Models\Applicants\ApplicantsEducation as Education;
use App\Models\Applicants\ApplicantsExperience as Experience;
use App\Models\Applicants\ApplicantsEligibility as Eligibility;
use App\Models\Applicants\ApplicantsAttachment as Attachment;
class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applicantsDashboard()
    {
        return view('hrapplicants.dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listOfApplicants()
    {
        $applicants = Applicant::all();
        return view('hrapplicants.list', compact('applicants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrapplicants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $applicant = new Applicant; 
        $applicant->firstname       = $request->firstname;
        $applicant->middlename      = $request->middlename;
        $applicant->lastname        = $request->lastname;
        $applicant->sex             = $request->sex;
        $applicant->birthday        = $request->birthday;
        $applicant->age             = $request->age;
        $applicant->contactNumber   = $request->contactNumber;
        $applicant->email           = $request->email;
        $applicant->homeAddress     = $request->homeAddress;
        $applicant->remarks         = $request->remarks;
        $applicant->hireStatus      = $request->hireStatus;
        $applicant->interviewStatus = $request->interviewStatus;
        $applicant->save();

        /*
         * Model ApplicantsEducation as Education creation
         *
         */
        foreach ($request->school as $i => $school) {
            $education = new Education;
            $education->program       = $request->program[$i];
            $education->school        = $school;
            $education->yearGraduated = $request->yearGraduated[$i] . '-01';
            $education->applicant()->associate($applicant);
            $education->save();
        }

        /*
         * Model ApplicantsExperience as Experience creation
         *
         */
        foreach ($request->agency as $i => $agency) {

            $dates = explode('to', $request->daterangeExperience[$i]);

            $experience = new Experience;
            $experience->agency       = $agency;
            $experience->position     = $request->position[$i];
            $experience->salaryGrade  = $request->salaryGrade[$i];
            $experience->start_date   = $dates[0];
            $experience->end_date     = $dates[1];
            $experience->applicant()->associate($applicant);
            $experience->save();
        }

        /*
         * Model ApplicantsEligibility as Eligibility creation
         *
         */
        foreach ($request->licenseTitle as $i => $licenseTitle) {

            $eligibility = new Eligibility;
            $eligibility->licenseTitle  = $licenseTitle;
            $eligibility->licenseNumber = $request->licenseNumber[$i];
            $eligibility->rating        = $request->rating[$i];
            $eligibility->exam_date     = $request->exam_date[$i] . '-01';
            $eligibility->applicant()->associate($applicant);
            $eligibility->save();
        }

        return redirect()->route('applicants.list');
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

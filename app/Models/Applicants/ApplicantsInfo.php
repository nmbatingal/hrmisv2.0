<?php

namespace App\Models\Applicants;

use App\Models\Applicants\ApplicantsInfo;
use Illuminate\Database\Eloquent\Model;

class ApplicantsInfo extends Model
{
    use Uuids;

    protected $table         = "applicants_infos";
    public    $incrementing  = false;
    protected $casts = [
        'hireStatus' 	  => 'boolean',
        'interviewStatus' => 'boolean',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 
        'lastname', 
        'middlename', 
        'sex',
        'birthday', 
        'age', 
        'contactNumber', 
        'email',
        'homeAddress',
        'remarks',
        'hireStatus',
        'interviewStatus',
    ];

    public function applicantAttachment()
    {
        return $this->hasMany('App\Models\Applicants\ApplicantsAttachment', 'applicant_id', 'id');
    }

    public function applicantEducations()
    {
        return $this->hasMany('App\Models\Applicants\ApplicantsEducation', 'applicant_id', 'id');
    }

    public function applicantEligibilities()
    {
        return $this->hasMany('App\Models\Applicants\ApplicantsEligibility', 'applicant_id', 'id');
    }

    public function applicantExperiences()
    {
        return $this->hasMany('App\Models\Applicants\ApplicantsExperience', 'applicant_id', 'id');
    }
}

<?php

namespace App\Models\Applicants;

use App\Uuids;
use Carbon\Carbon;
use App\Models\Applicants\ApplicantsInfo;
use App\Models\Applicants\ApplicantsAttachment;
use App\Models\Applicants\ApplicantsEducation;
use App\Models\Applicants\ApplicantsEligibility;
use App\Models\Applicants\ApplicantsExperience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantsInfo extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $connection    = 'mysql';
    protected $table         = "applicants_infos";
    public    $incrementing  = false;
    protected $dates = ['deleted_at'];
    protected $casts = [
        'hireStatus'      => 'boolean',
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

    // Applicant fullname accessor
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    // Applicant fullname accessor
    public function getBirthDateAttribute()
    {
        return Carbon::parse($this->birthday)->format('F d, Y');
    }

    public function applicantAttachments()
    {
        return $this->hasMany(ApplicantsAttachment::class, 'applicant_id', 'id');
    }

    public function applicantEducations()
    {
        return $this->hasMany(ApplicantsEducation::class, 'applicant_id', 'id');
    }

    public function applicantEligibilities()
    {
        return $this->hasMany(ApplicantsEligibility::class, 'applicant_id', 'id');
    }

    public function applicantExperiences()
    {
        return $this->hasMany(ApplicantsExperience::class, 'applicant_id', 'id');
    }
}

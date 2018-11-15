<?php

namespace App\Models\Applicants;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApplicantsExperience extends Model
{   
    protected $connection    = 'mysql3';
    protected $table = "applicants_experiences";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agency',
        'position',
        'salaryGrade',
        'start_date',
        'end_date',
        'applicant_id',
    ];

    // Applicant WORK EXPERIENCE accessor
    public function getWorkExperienceAttribute()
    {
        return "<b>{$this->position}</b>, {$this->agency}, " . Carbon::parse($this->end_date)->format('Y');
    }

    public function setStartDateAttribute($value) { 

        $this->attributes['start_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function setEndDateAttribute($value) { 

        $this->attributes['end_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function applicant()
    {
        return $this->belongsTo('App\Models\Applicants\ApplicantsInfo', 'applicant_id', 'id');
    }
}

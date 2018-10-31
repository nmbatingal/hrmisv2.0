<?php

namespace App\Models\Applicants;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApplicantsEducation extends Model
{
    protected $connection    = 'mysql';
    protected $table = "applicants_educations";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'program', 
        'school', 
        'yearGraduated', 
        'applicant_id',
    ];

    // Applicant EDUCATION accessor
    public function getEducationBackgroundAttribute()
    {
        return "<b>{$this->program}</b>, {$this->school}, " . Carbon::parse($this->yearGraduated)->format('Y');
    }

    public function applicant()
    {
        return $this->belongsTo('App\Models\Applicants\ApplicantsInfo', 'applicant_id', 'id');
    }
}

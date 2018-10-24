<?php

namespace App\Models\Applicants;

use Illuminate\Database\Eloquent\Model;

class ApplicantsEducation extends Model
{
    protected $table         = "applicants_educations";
    
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

    public function applicant()
    {
        return $this->belongsTo('App\Models\Applicants\ApplicantsInfo', 'applicant_id', 'id');
    }
}

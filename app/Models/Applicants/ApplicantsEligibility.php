<?php

namespace App\Models\Applicants;

use Illuminate\Database\Eloquent\Model;

class ApplicantsEligibility extends Model
{
    protected $table = "applicants_experiences";
    protected $dates = [
        'created_at', 
        'updated_at', 
        'exam_date',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'licenseTitle',
        'licenseNumber',
        'rating',
        'exam_date',
        'applicant_id',
    ];

    public function applicant()
    {
        return $this->belongsTo('App\Models\Applicants\ApplicantsInfo', 'applicant_id', 'id');
    }
}
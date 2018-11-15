<?php

namespace App\Models\Applicants;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApplicantsEligibility extends Model
{
    protected $connection    = 'mysql3';
    protected $table = "applicants_eligibilities";
    protected $dates = [
        'created_at', 
        'updated_at',
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

    // Applicant ELIGIBILITY accessor
    public function getLicensedAttribute()
    {
        return "{$this->licenseTitle}, " . Carbon::parse($this->exam_date)->format('Y');
    }

    public function applicant()
    {
        return $this->belongsTo('App\Models\Applicants\ApplicantsInfo', 'applicant_id', 'id');
    }
}
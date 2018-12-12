<?php

namespace App\Models\MoraleSurvey;

use App\MoraleSurvey\MorssSurvey;
use App\MoraleSurvey\MorssSurveyRemark;
use Illuminate\Database\Eloquent\Model;

class MorssSemester extends Model
{
    protected $connection = "mysql4";
    protected $table      = "morss_semesters";
    protected $casts = [
        'questions' => 'array',
        'status'    => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month_from',
        'month_to',
        'year',
        'status',
        'questions',
    ];

    public function moraleSurveys()
    {
        return $this->hasMany(MorssSurvey::class, 'semester_id', 'id');
    }

    public function moraleSurveyRemarks()
    {
        return $this->hasMany(MorssSurveyRemark::class, 'semester_id', 'id');
    }
}

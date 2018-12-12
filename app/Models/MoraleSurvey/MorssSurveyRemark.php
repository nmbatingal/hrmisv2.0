<?php

namespace App\Models\MoraleSurvey;

use App\User;
use App\MoraleSurvey\MoraleSemester;
use Illuminate\Database\Eloquent\Model;

class MorssSurveyRemark extends Model
{
    protected $connection = "mysql4";
    protected $table      = "morss_survey_remarks";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'semester_id',
        'user_id',
        'remarks',
    ];

    public function semester()
    {
        return $this->belongsTo(MoraleSemester::class, 'semester_id', 'id');
    }

    public function userEmployee()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

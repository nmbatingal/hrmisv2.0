<?php

namespace App\Models\MoraleSurvey;

use App\User;
use App\MoraleSurvey\MorssQuestion;
use App\MoraleSurvey\MoraleSemester;
use Illuminate\Database\Eloquent\Model;

class MorssSurvey extends Model
{
    protected $connection = "mysql4";
    protected $table      = "morss_surveys";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'semester_id',
        'user_id',
        'question_id',
        'rate',
    ];

    public function semester()
    {
        return $this->belongsTo(MoraleSemester::class, 'semester_id', 'id');
    }

    public function userEmployee()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function moraleQuestion()
    {
        return $this->belongsTo(MorssQuestion::class, 'question_id', 'id');
    }
}

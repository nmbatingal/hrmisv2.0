<?php

namespace App\Models\MoraleSurvey;

use Carbon\Carbon;
use App\Models\MoraleSurvey\MorssSurvey;
use App\Models\MoraleSurvey\MorssQuestion;
use App\Models\MoraleSurvey\MorssSurveyRemark;
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
        'uuid',
        'month_from',
        'month_to',
        'status',
        'questions',
    ];

    public function moraleSurveys()
    {
        return $this->hasMany(MorssSurvey::class, 'semester_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(MorssQuestion::class, 'questions', 'id');
    }

    public function moraleSurveyRemarks()
    {
        return $this->hasMany(MorssSurveyRemark::class, 'semester_id', 'id');
    }

    public function getSemesterAttribute()
    {
        $from = $this->monthStart;
        $to   = $this->monthEnd;

        return " $from - $to ";
    }

    public function getMonthStartAttribute()
    {
        return Carbon::parse($this->month_from)->format('M, Y');
    }

    public function getMonthEndAttribute()
    {
        return Carbon::parse($this->month_to)->format('M, Y');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeNowSurvey($query)
    {
        return $query->active()->latest();
    }
}

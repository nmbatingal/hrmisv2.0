<?php

namespace App\Models\MoraleSurvey;

use App\MoraleSurvey\MorssSurvey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MorssQuestion extends Model
{
    use SoftDeletes;

    protected $connection = "mysql4";
    protected $table      = "morss_questions";
    protected $dates = [ 
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
    ];

    public function moraleSurveys()
    {
        return $this->hasMany(MorssSurvey::class, 'question_id', 'id');
    }
}

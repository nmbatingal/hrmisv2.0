<?php

namespace App;

use App\User;
use App\Office;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{

    protected $connection   = 'mysql';
    protected $table        = "offices";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'division_name', 
        'div_acronym',
        'div_head_id',
        'receiver_id',
    ];

    public function divisionHead()
    {
        return $this->belongsTo(User::class, 'div_head_id', 'id');
    }

    public function userReceiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function order()
    {
        return "<asdasds>";
    }
}

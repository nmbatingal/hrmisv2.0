<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $connection   = 'mysql';
    protected $table        = "notifications";
    protected $casts = [
        'isSeen'  => 'boolean',
    ];
    protected $dates = [ 
        'seen_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'recipient_id',
        'route',
        'route_id',
        'isSeen',
        'seen_at',
        'remarks',
    ];

    public function userNotif()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function recipientNotif()
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }
}

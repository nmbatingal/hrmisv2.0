<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Uuids;

    protected $connection   = 'mysql';
    protected $table        = "users";
    public    $incrementing = false;
    protected $dates = ['deleted_at'];
    protected $casts = [
        'isactive' => 'boolean',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 
        'lastname', 
        'username',
        'email', 
        'mobile', 
        'password',
        'isActive',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verifyUser()
    {
        return $this->belongsTo('App\VerifyUser', 'user_id', 'id');
    }
}

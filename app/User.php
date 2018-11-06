<?php

namespace App;

use Auth;
use App\Office;
use App\VerifyUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    // use Uuids;

    protected $connection   = 'mysql';
    protected $table        = "users";
    // public    $incrementing = false;
    protected $dates = ['deleted_at'];
    protected $casts = [
        'isActive' => 'boolean',
        'isAdmin' => 'boolean',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 
        'middlename', 
        'lastname', 
        'username',
        'email', 
        'mobile', 
        'password',
        'office_id',
        'position',
        'isActive',
        'isAdmin',
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
        return $this->belongsTo(VerifyUser::class, 'user_id', 'id');
    }

    // User fullname accessor
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function scopeNotSelf($query)
    {
        return $query->where('id', '!=', Auth::user()->id);
    }

    public function scopeEmployeeOffice($query, $office)
    {
        return $query->where('office_id', $office);
    }

    public function scopeEmployee($query)
    {
        return $query->where('isActive', 1)
                     ->where('isAdmin', '!=', 1);
    }
}

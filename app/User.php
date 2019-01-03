<?php

namespace App;

use Auth;
use App\Office;
use App\VerifyUser;
use App\Notifications\MailResetPasswordNotification;
use App\Models\MoraleSurvey\MorssSurvey;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
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
        'sex',
        'birthday',
        'address',
        'user_image',
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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

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
                     ->where('isAdmin', '!=', 1)
                     ->orderBy('firstname', 'ASC');
    }


    // ---------------- MORALE SURVEY FUNCTIONS ------------------ //
    public function moraleSurveys()
    {
        return $this->hasMany(MorssSurvey::class, 'user_id', 'id');
    }

    // ---------------- END MORALE SURVEY FUNCTIONS -------------- //

}

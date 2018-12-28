<?php

namespace App;

use App\VerifyUser;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $connection = 'mysql';
    protected $table = 'verify_users';
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(VerifyUser::class, 'user_id', 'id');
    }
}

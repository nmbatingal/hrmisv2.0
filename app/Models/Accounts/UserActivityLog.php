<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id'
    ];
}

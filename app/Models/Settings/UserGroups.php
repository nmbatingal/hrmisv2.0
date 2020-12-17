<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\OfficeGroups;
use App\User;

class UserGroups extends Model
{
	protected $connection   = "mysql";
    protected $table        = "office_groups";
    public $incrementing  = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'group_id', 
        'designation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function officeGroup()
    {
        return $this->belongsTo(OfficeGroups::class, 'group_id', 'id');
    }
}

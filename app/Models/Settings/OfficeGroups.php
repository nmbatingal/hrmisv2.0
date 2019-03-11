<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\UserGroups;

class OfficeGroups extends Model
{
	protected $connection   = "mysql";
    protected $table        = "office_groups";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_name', 
        'acronym',
    ];

    public function userGroups()
    {
        return $this->hasMany(UserGroups::class, 'group_id', 'id');
    }
}

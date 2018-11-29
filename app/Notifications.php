<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $connection   = 'mysql';
    protected $table        = "notifications";
}

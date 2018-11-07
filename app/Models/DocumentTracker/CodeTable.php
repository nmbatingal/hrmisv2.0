<?php

namespace App\Models\DocumentTracker;

use Illuminate\Database\Eloquent\Model;

class CodeTable extends Model
{
    protected $connection   = 'mysql2';
    protected $table        = "code_table";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $hidden = [
        'doc_code',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeTable extends Model
{
    protected $connection   = 'mysql';
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

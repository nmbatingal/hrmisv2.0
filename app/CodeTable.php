<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeTable extends Model
{
    protected $connection   = 'mysql';
    protected $table        = "_code_table";
    public    $incrementing = false;
    public    $timestamps   = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $hidden = [
        'doc_code',
    ];
}

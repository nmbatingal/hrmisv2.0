<?php

namespace App\Models\DocumentTracker;

use Illuminate\Database\Eloquent\Model;

class DocumentKeyword extends Model
{
	protected $connection   = "mysql2";
    protected $table        = "document_keywords";
    public $incrementing  = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_id',
        'keywords',
    ];

    public function documentTracker()
    {
        return $this->belongsTo(DocumentTracker::class, 'document_id', 'id');
    }

    
}

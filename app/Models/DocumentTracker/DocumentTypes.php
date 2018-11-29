<?php

namespace App\Models\DocumentTracker;

use App\Models\DocumentTracker\DocumentTracker;
use Illuminate\Database\Eloquent\Model;

class DocumentTypes extends Model
{
    protected $connection   = "mysql2";
    protected $table        = "document_types";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_name',
    ];

    public function documentTypes()
    {
        return $this->hasMany(DocumentTracker::class, 'doc_type_id', 'id');
    }
}

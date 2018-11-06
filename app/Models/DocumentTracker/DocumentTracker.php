<?php

namespace App\Models\DocumentTracker;

use App\User;
use Carbon\Carbon;
use App\Models\DocumentTracker\DocumentTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentTracker extends Model
{
    use SoftDeletes;

    protected $connection = "mysql2";
    protected $table = "document_trackers";
    protected $dates = [ 
        'document_date', 
        'deleted_at',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'tracking_code',
        'user_id',
        'doc_type_id',
        'subject',
        'details',
        'keywords',
        'attachments',
        'document_date',
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentTypes::class, 'doc_type_id', 'id');
    }

    public function userEmployee()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

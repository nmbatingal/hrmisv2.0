<?php

namespace App\Models\DocumentTracker;

use App\Models\DocumentTracker\DocumentTracker;
use App\Models\DocumentTracker\DocumentTrackingLogs;
use Illuminate\Database\Eloquent\Model;

class DocumentTrackerAttachment extends Model
{
    protected $connection = "mysql2";
    protected $table 	  = "doctracking_attachments";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctracker_id',
        'tracklog_id',
        'filename',
        'filepath',
        'filesize',
    ];

    public function documentTracker()
    {
        return $this->belongsTo(DocumentTracker::class, 'doctracker_id', 'id');
    }
}

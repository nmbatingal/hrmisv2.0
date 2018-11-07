<?php

namespace App\Models\DocumentTracker;

use App\User;
use Carbon\Carbon;
use App\Models\DocumentTracker\DocumentTracker;
use Illuminate\Database\Eloquent\Model;

class DocumentTrackingLogs extends Model
{
    protected $connection = "mysql2";
    protected $table = "document_tracking_logs";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'tracking_code',
        'action',
        'sender_id',
        'office_id',
        'recipient_id',
        'remarks',
        'attachment',
    ];

    public function documentCode()
    {
        return $this->belongsTo(DocumentTracker::class, 'code', 'code');
    }

    public function documentTracker()
    {
        return $this->belongsTo(DocumentTracker::class, 'tracking_code', 'tracking_code');
    }

    public function userEmployee()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

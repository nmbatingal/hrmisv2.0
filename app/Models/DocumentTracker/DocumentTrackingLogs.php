<?php

namespace App\Models\DocumentTracker;

use App\User;
use App\Office;
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
        'notes',
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
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function getDateActionAttribute()
    {
        return Carbon::parse($this->created_at)->toDayDateTimeString();
    }

    public function getDiffForHumansAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}

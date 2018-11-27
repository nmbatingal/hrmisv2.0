<?php

namespace App\Models\DocumentTracker;

use App\User;
use App\Office;
use Carbon\Carbon;
use App\Models\DocumentTracker\DocumentTracker;
use App\Models\DocumentTracker\DocumentTrackerAttachment;
use Illuminate\Database\Eloquent\Model;

class DocumentTrackingLogs extends Model
{
    protected $connection = "mysql2";
    protected $table = "document_tracking_logs";
    protected $casts = [
        'recipients' => 'array',
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
        'action',
        'route_mode',
        'recipients',
        'notes',
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

    public function routeToOffice()
    {
        return $this->belongsTo(Office::class, 'route_to_office_id', 'id');
    }

    public function routeToUser()
    {
        return $this->belongsTo(Office::class, 'route_to_user_id', 'id');
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

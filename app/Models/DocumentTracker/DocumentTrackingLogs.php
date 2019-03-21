<?php

namespace App\Models\DocumentTracker;

use App\User;
use App\Office;
use Carbon\Carbon;
use App\Models\DocumentTracker\DocumentTracker;
use App\Models\DocumentTracker\DocumentTrackerAttachment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DocumentTrackingLogs extends Model
{
    use SoftDeletes;

    protected $connection = "mysql2";
    protected $table = "document_tracking_logs";
    protected $casts = [
        'recipients'     => 'array',
        'forSignature'   => 'boolean',
        'forCompliance'  => 'boolean',
        'forInformation' => 'boolean',
    ];
    protected $dates = [ 
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
        'action',
        'forSignature',
        'forCompliance',
        'forInformation',
        'route_mode',
        'recipients',
        'notes',
        'remarks',
    ];

    public function documentCode()
    {
        // return $this->belongsTo(DocumentTracker::class, 'code', 'code')->withTrashed();
        return $this->belongsTo(DocumentTracker::class, 'code', 'code');
    }

    public function documentTracker()
    {
        // return $this->belongsTo(DocumentTracker::class, 'tracking_code', 'tracking_code')->withTrashed();
        return $this->belongsTo(DocumentTracker::class, 'tracking_code', 'tracking_code');
    }

    public function userEmployee()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getLogActionAttribute()
    {
        return "<h5 class='font-weight-bold'>" . $this->action . "</h5> (" . ucwords($this->route_mode) . ")";
    }

    public function getDateActionAttribute()
    {
        // return Carbon::parse($this->created_at)->toDayDateTimeString();
        // return Carbon::parse($this->created_at)->toFormattedDateString() . ' ' . Carbon::parse($this->created_at)->toTimeString();
        return Carbon::parse($this->created_at)->format('M-d-o h:ia');
        // return date_format($this->created_at, 'M-d-o h:ia');
    }

    public function getDiffForHumansAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}

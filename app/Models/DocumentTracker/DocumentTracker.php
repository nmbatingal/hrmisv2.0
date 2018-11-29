<?php

namespace App\Models\DocumentTracker;

use DB;
use Auth;
use App\User;
use App\Office;
use Carbon\Carbon;
use App\Models\DocumentTracker\DocumentTypes;
use App\Models\DocumentTracker\DocumentTrackingLogs;
use App\Models\DocumentTracker\DocumentTrackerAttachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

class DocumentTracker extends Model
{
    use SoftDeletes;

    protected $connection = "mysql2";
    protected $table = "document_trackers";
    protected $casts = [
        'isRouteComplete' => 'boolean',
        'isDocCancelled'  => 'boolean',
    ];
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
        'creator_id',
        'recipient_id',
        'route_to_office_id',
        'route_to_user_id',
        'doc_type_id',
        'document_date',
        'subject',
        'details',
        'keywords',
        'isRouteComplete',
        'isDocCancelled',
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentTypes::class, 'doc_type_id', 'id');
    }

    public function userEmployee()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function recipientUser()
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }

    public function routeToOffice()
    {
        return $this->belongsTo(Office::class, 'route_to_office_id', 'id');
    }

    public function routeToUser()
    {
        return $this->belongsTo(Office::class, 'route_to_user_id', 'id');
    }

    public function docAttachments()
    {
        return $this->hasMany(DocumentTrackerAttachment::class, 'doctracker_id', 'id');
    }

    public function trackLogs()
    {
        return $this->hasMany(DocumentTrackingLogs::class, 'tracking_code', 'tracking_code');
    }

    public function scopeLastTracked($query)
    {
        $log =  $this->trackLogs()->latest()->first();
        return "{$log->dateAction} <br>({$log->diffForHumans})";
    }

    public function scopeMyDocuments($query)
    {
        return $query->where('creator_id', Auth::user()->id)
                          ->orderBy('document_trackers.created_at', 'DESC')
                          ->join('document_tracking_logs', function($join) {
                                $join->on('document_tracking_logs.id', '=', DB::raw('(SELECT DISTINCT (id) FROM document_tracking_logs
                                                WHERE code = document_trackers.code
                                                ORDER BY created_at DESC
                                                LIMIT 1)'));
                            });
    }

    public function getDateOfDocumentAttribute()
    {
        return Carbon::parse($this->document_date)->format('M-d-Y');
    }

    public function getTrackingDateAttribute()
    {
        return Carbon::parse($this->created_at)->toDayDateTimeString();
    }

    public function getBarcodeLogoAttribute()
    {
        $barcode = new BarcodeGenerator();
        $barcode->setText($this->code);
        $barcode->setType(BarcodeGenerator::Code39);
        $barcode->setLabel($this->tracking_code);
        $barcode->setThickness(30);
        $barcode->setFontSize(8);
        $code = $barcode->generate();
        
        return '<img src="data:image/png;base64,'.$code.'" height="45px" />';
    }
}

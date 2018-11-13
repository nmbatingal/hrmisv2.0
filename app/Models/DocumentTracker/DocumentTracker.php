<?php

namespace App\Models\DocumentTracker;

use DB;
use Auth;
use App\User;
use App\Office;
use Carbon\Carbon;
use App\Models\DocumentTracker\DocumentTypes;
use App\Models\DocumentTracker\DocumentTrackingLogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

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
        'office_id',
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

    public function userDivision()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(DocumentTrackingLogs::class, 'tracking_code', 'tracking_code');
    }

    public function scopeLastTracked($query)
    {
        $log =  $this->logs()->latest()->first();
        return "{$log->dateAction} <br>({$log->diffForHumans})";
    }

    public function scopeMyDocuments($query)
    {
        /*return $query->where('document_trackers.user_id', Auth::user()->id)
                     ->leftJoin('document_tracking_logs', function($join) {
                         $join->on('document_tracking_logs.tracking_code', '=', 'document_trackers.tracking_code')
                              ->orderBy('document_tracking_logs.created_at', 'DESC')
                              ->limit(1);
                     })->orderBy('document_trackers.created_at', 'DESC');*/

        $trackers = $query->where('user_id', Auth::user()->id)
                          ->orderBy('document_trackers.created_at', 'DESC')
                          ->join('document_tracking_logs', function($join) {
                                $join->on('document_tracking_logs.id', '=', DB::raw('(SELECT DISTINCT (id) FROM document_tracking_logs
                                                WHERE code = document_trackers.code
                                                ORDER BY created_at DESC
                                                LIMIT 1)'));
                            });

        // $trackers = DB::select( DB::raw("SELECT * FROM doctracker.document_trackers"));

        return $trackers;
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

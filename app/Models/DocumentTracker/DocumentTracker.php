<?php

namespace App\Models\DocumentTracker;

use Auth;
use App\User;
use App\Office;
use Carbon\Carbon;
use App\Models\DocumentTracker\DocumentTypes;
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

    public function scopeMyDocuments($query)
    {
        return $query->where('user_id', Auth::user()->id);
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

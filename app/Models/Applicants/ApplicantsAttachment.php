<?php

namespace App\Models\Applicants;

use Illuminate\Database\Eloquent\Model;

class ApplicantsAttachment extends Model
{
    protected $connection    = 'mysql3';
    protected $table = "applicants_attachments";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename',
        'filesize',
        'filepath',
        'applicant_id',
    ];

    public function applicant()
    {
        return $this->belongsTo('App\Models\Applicants\ApplicantsInfo', 'applicant_id', 'id');
    }
}

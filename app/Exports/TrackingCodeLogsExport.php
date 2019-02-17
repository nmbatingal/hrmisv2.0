<?php

namespace App\Exports;

use App\Models\DocumentTracker\DocumentTrackingLogs;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;

// class UsersExport implements FromQuery, Responsable
class TrackingCodeLogsExport implements FromView, ShouldQueue, Responsable
{
	use Exportable;

	private $fileName = 'routinglogs.xlsx';

	public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function query()
    {
        return User::query()->where('id', $this->user_id);
    }*/

    public function view(): View
    {
        $documentsLog = DocumentTrackingLogs::where('tracking_code', $this->code)->latest()->get();

        return view('optima.exports.routeddocuments', [
            'documentsLog'  => $documentsLog
        ]);
    }
}


<?php

namespace App\Exports;

use App\User;
use App\Models\DocumentTracker\DocumentTrackingLogs;
// use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;

// class UsersExport implements FromQuery, Responsable
class UsersExport implements FromView, ShouldQueue
{
	use Exportable;

	private $fileName = 'users.xlsx';

	public function __construct(int $id)
    {
        $this->user_id = $id;
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

        $documentsLog = DocumentTrackingLogs::where('user_id', $this->user_id)->latest()->get();

        return view('doctracker.exports.routeddocuments', [
            'users' 		=> User::all(),
            'documentsLog'  => $documentsLog
        ]);
    }
}

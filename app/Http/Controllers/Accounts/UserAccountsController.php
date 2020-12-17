<?php

namespace App\Http\Controllers\Accounts;

use Hash;
use Auth;
use Session;
use App\User;
use App\Office;
use App\Helpers\LogActivity;
use App\Models\Accounts\UserActivityLog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('accounts.account', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function log()
    {
        $logs = UserActivityLog::where('user_id', Auth::user()->id )->latest()->get();
        
        return view('accounts.activity-log', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePhoto(Request $request)
    {
        // if ( $request->has('croppedImage'))
        // {
        //     // foreach ($request->croppedImage as $i => $file) {
        //         // $doc_id      = $document->id;
        //         // $foldercode  = $document->tracking_code;
        //         // $code        = $document->code;
        //         // $destination = 'upload/documenttracker/'.$foldercode.'/'; 
        //         // $filename    = $doc_id .'-TR-'. $code .' '. $file->getClientOriginalName();
        //         // $filesize    = $file->getClientSize();

        //         // $docu                = new DocumentTrackerAttachment;
        //         // $docu->doctracker_id = $doc_id;
        //         // $docu->filename      = $file->getClientOriginalName();
        //         // $docu->filepath      = $destination.$filename;
        //         // $docu->filesize      = $filesize;

        //         // $file->move($destination, $filename);
        //         // $docu->save();
        //     // }
        //     return $request->croppedImage->getClientOriginalName();
        // }

        return dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offices = Office::all();
        $user = User::find($id);
        return view('accounts.edit', compact('user', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->firstname       = $request->firstname;
        $user->middlename       = $request->middlename;
        $user->lastname       = $request->lastname;
        $user->sex       = $request->sex;
        $user->birthday       = $request->birthday;
        $user->address       = $request->address;
        $user->email       = $request->email;
        $user->mobile       = $request->mobile;
        $user->office_id       = $request->office;
        $user->position       = $request->position;
        $user->save();

        LogActivity::addToLog('updated account information.');
        return redirect()->route('myaccount.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        $item = [
            [   
                'icon'    => '',
                'heading' => '<h5 class="text-success m-0"><i class="fa fa-check-circle"></i> Success</h5>',
                'text'    => '<small class="text-muted">'.$user->diffTime.'</small><p class="p-t-10">Password successfully updated.</p>'  
            ],
         ];

        LogActivity::addToLog('updated user password.');
        // Session::push('cart', $item);
        $request->session()->flash('cart', $item);
        return redirect()->route('myaccount.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

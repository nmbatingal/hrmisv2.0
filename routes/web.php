<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return redirect()->route('login'); })->name('home');

Auth::routes();


Route::group(['middleware' => 'auth'], function() {

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');

	// ----------- DOCUMENT TRACKER SYSTEM ------------- //
	Route::get('/doctracker/dashboard', 'DocumentTracker\DocumentTrackerController@index')->name('doctracker.dashboard');
	Route::get('/doctracker/dashboard/search', 'DocumentTracker\DocumentTrackerController@search')->name('doctracker.search');
	Route::get('/doctracker/mydocuments', 'DocumentTracker\DocumentTrackerController@myDocuments')->name('doctracker.mydocuments');
	Route::get('/doctracker/mydocuments/create', 'DocumentTracker\DocumentTrackerController@create')->name('doctracker.createTracker');
	Route::get('/doctracker/mydocuments/{tracking_code}', 'DocumentTracker\DocumentTrackerController@showDocument')->name('doctracker.showdocument');
	Route::get('/doctracker/receiveddocuments', 'DocumentTracker\DocumentTrackerController@receivedDocuments')->name('doctracker.receivedDocuments');
	Route::get('/doctracker/receiveddocuments/{tracking_code}', 'DocumentTracker\DocumentTrackerController@showReceivedDocument')->name('doctracker.showReceivedDocument');
	Route::post('/doctracker/receiveddocuments/receive', 'DocumentTracker\DocumentTrackerController@recieveForwardedDocument')->name('doctracker.recieveForwardedDocument');
	Route::post('/doctracker/receiveddocuments/forwardDocument', 'DocumentTracker\DocumentTrackerController@forwardDocument')->name('doctracker.forwardDocument');
	Route::post('/doctracker/create/recipients', 'DocumentTracker\DocumentTrackerController@recipientList')->name('doctracker.recipientlist');
	Route::resource('/doctracker', 'DocumentTracker\DocumentTrackerController');
	// ----------- DOCUMENT TRACKER SYSTEM ------------- //

	// ----------- HR-APPLICANTS SYSTEM ------------- //
	Route::get('/hr/dashboard', 'Applicants\ApplicantsController@applicantsDashboard')->name('applicants.dashboard');
	Route::get('/hr/applicants/list', 'Applicants\ApplicantsController@listOfApplicants')->name('applicants.list');
	Route::resource('/hr/applicants', 'Applicants\ApplicantsController');
	// ----------- HR-APPLICANTS SYSTEM ------------- //

});
/*
 * SAMPLE ROUTES
 *
 */
Route::get('/send', function(Request $request) {
    
    $office = App\Office::find(2)->first();
    
    return json_encode($office);

    // return dd($request);
})->name('submit');
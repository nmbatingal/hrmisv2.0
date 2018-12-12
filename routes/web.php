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
Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');

Auth::routes();
Route::group(['middleware' => 'auth'], function() {

	Route::get('/home', 'HomeController@index')->name('home');

	// ----------- DOCUMENT TRACKER SYSTEM ------------- //
	Route::get('/doctracker/dashboard', 'DocumentTracker\DocumentTrackerController@index')->name('doctracker.dashboard');
	Route::get('/doctracker/logs', 'DocumentTracker\DocumentTrackerController@logs')->name('doctracker.logs');
	Route::get('/doctracker/logs/search', 'DocumentTracker\DocumentTrackerController@search')->name('doctracker.search');

	Route::get('/doctracker/mydocuments', 'DocumentTracker\DocumentTrackerController@myDocuments')->name('doctracker.mydocuments');
	Route::get('/doctracker/mydocuments/create', 'DocumentTracker\DocumentTrackerController@create')->name('doctracker.create.tracker');
	Route::get('/doctracker/mydocuments/{code?}', 'DocumentTracker\DocumentTrackerController@showDocument')->name('doctracker.showDocument');
	Route::get('/doctracker/mydocuments/{id}/print', 'Pdf\PdfController@printBarcode')->name('print.barcode');

	Route::get('/doctracker/incoming', 'DocumentTracker\DocumentTrackerController@incomingDocuments')->name('doctracker.incoming');
	Route::get('/doctracker/incoming/{code?}', 'DocumentTracker\DocumentTrackerController@showIncoming')->name('doctracker.incoming.show');
	Route::post('/doctracker/incoming', 'DocumentTracker\DocumentTrackerController@receiveIncomingDocument')->name('doctracker.incoming.receive');

	Route::get('/doctracker/outgoing', 'DocumentTracker\DocumentTrackerController@outgoingDocuments')->name('doctracker.outgoing');
	Route::post('/doctracker/outgoing', 'DocumentTracker\DocumentTrackerController@searchOutgoing')->name('doctracker.outgoing.receive');
	Route::post('/doctracker/outgoing/store', 'DocumentTracker\DocumentTrackerController@storeOutgoing')->name('doctracker.outgoing.store');


	Route::post('/doctracker/create/recipients', 'DocumentTracker\DocumentTrackerController@recipientList')->name('doctracker.recipientlist');
	Route::resource('/doctracker', 'DocumentTracker\DocumentTrackerController');
	// ----------- DOCUMENT TRACKER SYSTEM ------------- //




	// ----------- HR-APPLICANTS SYSTEM ------------- //
	Route::get('/hr/dashboard', 'Applicants\ApplicantsController@applicantsDashboard')->name('applicants.dashboard');
	Route::get('/hr/applicants/list', 'Applicants\ApplicantsController@listOfApplicants')->name('applicants.list');
	Route::resource('/hr/applicants', 'Applicants\ApplicantsController');
	// ----------- HR-APPLICANTS SYSTEM ------------- //


	// ----------- START MORALE SURVEY SYSTEM ------------- //
	Route::get('/moralesurvey/dashboard', 'MoraleSurvey\MoraleSurveyController@dashboard')->name('moralesurvey.dashboard');
	Route::get('/moralesurvey/setting', 'MoraleSurvey\MoraleSurveyController@dashboard')->name('moralesurvey.dashboard');

	Route::get('/moralesurvey/setting/semester', 'MoraleSurvey\MoraleSurveyController@dashboard')->name('moralesurvey.setting.semester');

	Route::resource('/moralesurvey', 'MoraleSurvey\MoraleSurveyController');
	// ----------- END MORALE SURVEY SYSTEM --------------- //


});

/*
 * SAMPLE ROUTES
 *
 */
Route::get('/send', function(Request $request) {
    
    $office = App\Office::find(2)->first();
  
    return response()->json($office);

})->name('submit');
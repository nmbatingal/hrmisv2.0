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

	// ----------- SYSTEM ADMIN SETTING ------------- //
	Route::post('/user/setting/{id}/password', 'Settings\UserSettingsController@updatePassword')->name('user.setting.update.password');
	Route::get('/user/setting/{id}/log', 'Settings\UserSettingsController@log')->name('user.setting.log');
	Route::resource('/user/setting', 'Settings\UserSettingsController', [ 'as' => 'user']);
	Route::resource('/setting', 'Settings\AdminSettingsController', [ 'as' => 'all']);
	// ----------- END SYSTEM ADMIN SETTING ------------- //

	// ----------- DOCUMENT TRACKER SYSTEM ------------- //
	// Route::get('/doctracker/about', 'DocumentTracker\DocumentTrackerController@about')->name('optima.about');
	// Route::get('/doctracker/dashboard', 'DocumentTracker\DocumentTrackerController@index')->name('doctracker.dashboard');
	// Route::get('/doctracker/logs', 'DocumentTracker\DocumentTrackerController@logs')->name('doctracker.logs');
	// Route::get('/doctracker/logs/search', 'DocumentTracker\DocumentTrackerController@searchJS')->name('doctracker.search');

	// Route::get('/doctracker/mydocuments', 'DocumentTracker\DocumentTrackerController@myDocuments')->name('doctracker.mydocuments');
	// Route::get('/doctracker/mydocuments/create', 'DocumentTracker\DocumentTrackerController@create')->name('doctracker.create.tracker');
	// Route::get('/doctracker/mydocuments/{code?}', 'DocumentTracker\DocumentTrackerController@showMyDocument')->name('doctracker.showDocument');
	// Route::get('/doctracker/mydocuments/{code}/print', 'Pdf\PdfController@printBarcode')->name('print.barcode');

	// Route::get('/doctracker/incoming/{code?}', 'DocumentTracker\DocumentTrackerController@showRoutedDocument')->name('doctracker.show.routed');
	// Route::get('/doctracker/incoming/search', 'DocumentTracker\DocumentTrackerController@searchIncomingDocument')->name('doctracker.incoming.search');
	// Route::post('/doctracker/incoming/store', 'DocumentTracker\DocumentTrackerController@storeIncomingDocument')->name('doctracker.incoming.store');

	// Route::get('/doctracker/outgoing/search', 'DocumentTracker\DocumentTrackerController@searchOutgoingDocument')->name('doctracker.outgoing.search');
	// Route::post('/doctracker/outgoing/store', 'DocumentTracker\DocumentTrackerController@storeOutgoingDocument')->name('doctracker.outgoing.store');

	// Route::post('/doctracker/create/recipients', 'DocumentTracker\DocumentTrackerController@recipientsList')->name('doctracker.recipientsList');
	// Route::resource('/doctracker/trackinglog', 'DocumentTracker\DocumentTrackingLogsController', [ 'as' => 'doctracker']);
	
	// ----------- DOCUMENT TRACKER SYSTEM ------------- //


	// ----------- HR-APPLICANTS SYSTEM ------------- //
	Route::get('/hr/dashboard', 'Applicants\ApplicantsController@applicantsDashboard')->name('applicants.dashboard');
	Route::get('/hr/applicants/list', 'Applicants\ApplicantsController@listOfApplicants')->name('applicants.list');
	Route::resource('/hr/applicants', 'Applicants\ApplicantsController');
	// ----------- HR-APPLICANTS SYSTEM ------------- //


	// ----------- START MORALE SURVEY SYSTEM ------------- //
	Route::get('/moralesurvey/dashboard', 'MoraleSurvey\MoraleSurveyController@dashboard')->name('moralesurvey.dashboard');

	// Survey Controller
	Route::get('/moralesurvey/survey/{uuid}', 'MoraleSurvey\SurveyController@survey')->name('survey.takesurvey');
	Route::resource('/moralesurvey/survey', 'MoraleSurvey\SurveyController');
	
    // Question Controller
	Route::resource('/moralesurvey/setting/question', 'MoraleSurvey\QuestionController');
	
    // Semester Controller
	Route::resource('/moralesurvey/setting/semester', 'MoraleSurvey\SemesterController');
	Route::resource('/moralesurvey', 'MoraleSurvey\MoraleSurveyController');
	// ----------- END MORALE SURVEY SYSTEM --------------- //
});

// OPTIMA ROUTING SERVICES
Route::group(['middleware' => 'auth', 'as' => 'optima.', 'prefix' => '/optima'], function() {

    Route::get('/', 'DocumentTracker\DocumentTrackerController@index')->name('index');
	Route::get('about', 'DocumentTracker\DocumentTrackerController@about')->name('about');
	Route::get('dashboard', 'DocumentTracker\DocumentTrackerController@dashboard')->name('dashboard');
    Route::get('about', 'DocumentTracker\DocumentTrackerController@about')->name('about');

	// DOCUMENT ROUTING MODULE
	Route::get('route-documents', 'DocumentTracker\DocumentTrackerController@routingDocuments')->name('route-documents');
	Route::get('route-documents/search', 'DocumentTracker\DocumentTrackerController@searchJS')->name('route-documents.search');
	Route::get('route-documents/export', 'DocumentTracker\DocumentTrackerController@exportRoutedDocuments')->name('route-documents.export');
	Route::get('route-documents/export/{code}', 'DocumentTracker\DocumentTrackerController@exportRoutedCodeDocuments')->name('route-documents.export.code');

	// DOCUMENT LOGS
	// Route::get('logs', 'DocumentTracker\DocumentTrackerController@logs')->name('logs');

    // INCOMING
    // Route::get('route-documents/incoming/search', 'DocumentTracker\DocumentTrackerController@searchIncomingDocument')->name('incoming.search');
    Route::post('route-documents/incoming/store', 'DocumentTracker\DocumentTrackerController@storeIncomingDocument')->name('incoming.store');

    // OUTGOING
    // Route::get('route-documents/outgoing/search', 'DocumentTracker\DocumentTrackerController@searchOutgoingDocument')->name('outgoing.search');
    Route::post('route-documents/outgoing/store', 'DocumentTracker\DocumentTrackerController@storeOutgoingDocument')->name('outgoing.store');

	// DOCUMENT CREATION MODULE
	Route::get('my-documents', 'DocumentTracker\DocumentTrackerController@myDocuments')->name('my-documents');
	// Route::get('my-documents/create', 'DocumentTracker\DocumentTrackerController@create')->name('create.tracker');
	Route::get('my-documents/{code?}', 'DocumentTracker\DocumentTrackerController@showMyDocument')->name('showDocument');
	Route::get('my-documents/{code}/print', 'Pdf\PdfController@printBarcode')->name('print.barcode');

    // DOCTRACKER RECIPIENT LIST
    Route::get('keywords', 'DocumentTracker\DocumentTrackerController@searchKeywords')->name('keywords');
    Route::post('recipients', 'DocumentTracker\DocumentTrackerController@recipientsList')->name('recipients');

	// OPTIMA DOCTRACKER RESOURCES
	Route::resource('/my-documents', 'DocumentTracker\DocumentTrackerController', [
        /*'names' => [
            'create'    => 'my-documents.create',
            'show'      => 'my-documents.show',
        ]*/
    ])->except(['index']);


});

Route::get('add-to-log', 'HomeController@myTestAddToLog');
Route::get('logActivity', 'HomeController@logActivity');

/*
 * SAMPLE ROUTES
 *
 */
Route::get('/send', function(Request $request) {
    
    $office = App\Office::find(2)->first();
  
    return response()->json($office);

})->name('submit');
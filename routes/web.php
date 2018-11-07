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

Route::get('/', function () { return view('home'); })->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');

/*
 * DOCUMENT TRACKER SYSTEM
 *
 */
Route::get('/doctracker/dashboard', 'DocumentTracker\DocumentTrackerController@index')->name('doctracker.dashboard');
Route::get('/doctracker/mydocuments', 'DocumentTracker\DocumentTrackerController@myDocuments')->name('doctracker.mydocuments');
Route::get('/doctracker/mydocuments/{tracking_code}', 'DocumentTracker\DocumentTrackerController@showDocument')->name('doctracker.showdocument');
Route::post('/doctracker/create/recipients', 'DocumentTracker\DocumentTrackerController@showEmployeeList')->name('doctracker.recipientlist');
Route::resource('/doctracker', 'DocumentTracker\DocumentTrackerController');

/*
 * HR-APPLICANTS SYSTEM
 *
 */
Route::get('/hr/dashboard', 'Applicants\ApplicantsController@applicantsDashboard')->name('applicants.dashboard');
Route::get('/hr/applicants/list', 'Applicants\ApplicantsController@listOfApplicants')->name('applicants.list');
Route::resource('/hr/applicants', 'Applicants\ApplicantsController');


/*
 * SAMPLE ROUTES
 *
 */
Route::get('/send', function(Request $request) {
	
    $office = App\Office::find(2)->first();
	
	return json_encode($office);

	// return dd($request);
})->name('submit');
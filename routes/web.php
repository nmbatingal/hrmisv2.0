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

Route::get('/', function () {
    return view('home');
})->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');

Route::get('/hr/dashboard', 'Applicants\ApplicantsController@applicantsDashboard')->name('applicants.dashboard');
Route::get('/hr/applicants/list', 'Applicants\ApplicantsController@listOfApplicants')->name('applicants.list');
Route::resource('/hr/applicants', 'Applicants\ApplicantsController');


Route::resource('/doctracker', 'DocTracker\DocTrackerController');

Route::post('/send', function(Request $request) {

	return dd($request);

})->name('submit');
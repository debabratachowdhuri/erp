<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('login.signin');
});
Route::group(array('before' => 'auth'), function()
{

	Route::get('emp','FeesCollectionController@index');

	Route::post('add','FeesCollectionController@create');

	Route::get('addrec','FeesCollectionController@store');

	Route::get('collect','FeesCollectionController@collect');

	Route::get('/sid',array('sid'=>'{id}','uses'=>'FeesCollectionController@getid'));

	Route::get('/month',array('sid'=>'{id}','uses'=>'FeesCollectionController@getmonth'));

	Route::post('save','FeesCollectionController@collecfee');

	Route::get('collection','FeesCollectionController@collectionstatement');

	Route::get('dailycollection','FeesCollectionController@dailycollectionstatement');

	Route::get('monthlycollection','FeesCollectionController@monthlycollectionstatement');

	Route::get('/deletefee',array('receiptno'=>'{receiptno}','uses'=>'FeesCollectionController@deletefee'));

	Route::post('show','FeesCollectionController@customreport');

	Route::get('reprint/{receipt_no}','FeesCollectionController@reprint');

	Route::get('viewstudent','StudentController@index');

	Route::any('showstudent','StudentController@showstudent');

	Route::get('addstudent','StudentController@addstudent');

	Route::post('savestudent','StudentController@savestudent');

	Route::any('editstudent','StudentController@editstudent');

	Route::get('/deletestudent',array('sid'=>'{sid}','uses'=>'StudentController@deletestudent'));

	Route::get('/settings','SettingsController@index');

	Route::post('/savesettings','SettingsController@save_settings');

	Route::get('logout','HomeController@doLogout');

	Route::get('faculty','FacultyController@index');

	Route::get('addfaculty','FacultyController@addfaculty');

	Route::post('savefaculty','FacultyController@savefaculty');

	Route::get('editfaculty','FacultyController@editfaculty');

	Route::get('deletefaculty','FacultyController@deletefaculty');
	
	Route::get('createlogin','HomeController@createlogin');
});

Route::get('login','HomeController@login');

Route::post('/signin','HomeController@signin');


/*Route::group(array('before' => 'auth'), function()
{
    Route::get('login', 'HomeController@login');
});*/


<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
	public function login()
	{
		return View::make('login.signin');
	}

	public function signin() {
		 $loogindata = array(
    	    'userid'     => Input::get('username'),
        	'password'  => Input::get('password')
	    );

		 if (Auth::attempt($loogindata)) { 
		 		return Redirect::to('/collect');
		} else { 
		    return Redirect::to('/login')->with('message', 'Your username/password combination was incorrect');
		}            
	}

	public function doLogout()
	{
	    Auth::logout(); // log the user out of our application
	    return Redirect::to('login'); // redirect the user to the login screen
	}

	public function createlogin()
	{
		 	 $user = new User;

			 	 $use = DB::table('users')->where('id', '=', Input::get('id'))->get();
			 	 if(count($use)>0){
			 	 	DB::table('users')
					->where('id', Input::get('id'))
		            ->update(array(
	            		'userid'    => Input::get('username'),
	            		'password'=> Hash::make(Input::get('password')),
	            		));
			 	 }
			 	 else{
					 	 $user->id          = Input::get('id');
						 $user->userid      = Input::get('username');
						 $user->password      = Hash::make(Input::get('password'));
						 $user->save();
					}
	}

}

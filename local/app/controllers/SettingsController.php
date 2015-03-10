<?php
	class SettingsController extends \BaseController {

		public function index()
		{
			  $settings = Settings::get(); //for all record
	          return View::make('settings.index', array('settings'=>$settings));
		}

		public function save_settings()
		{  
			$config = new Settings();
			$settings = Settings::get();

			//File Upload

			$file = Input::file('logo');
			if(count($file) > 0){
			$destinationPath = app_path().'/../../assets/img/custom/';
			$filename = $file->getClientOriginalName();
			Input::file('logo')->move($destinationPath, $filename);
			chmod(app_path().'/../../assets/img/custom/'.$filename,777);
		}	
			foreach ($settings as $value) {
				if($value->param == "logo")
				{
					if(count($file) > 0){
					DB::table('settings')
					->where('param', $value->param)
	   		                ->update(array('value' => $filename));
	   		               }
				}	
				else
				{
					DB::table('settings')
					->where('param', $value->param)
		                        ->update(array('value' => Input::get($value->param)));
	            }  
	        }

			
			   
			return Redirect::to('settings');
		}
}
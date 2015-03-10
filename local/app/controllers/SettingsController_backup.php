<?php
	class SettingsController extends \BaseController {

		public function index()
		{
			  $settings = Settings::get(); //for all record
	          return View::make('settings.index', array('settings'=>$settings));
		}

		public function save_seetings()
		{
			$config = new Settings();
			$settings = Settings::get();
			foreach ($settings as $value) {
				DB::table('settings')
				->where('param', $value->param)
	            ->update(array('value' => Input::get($value->param)));
            }     
			return Redirect::to('settings');
		}
}
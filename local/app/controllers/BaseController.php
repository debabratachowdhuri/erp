<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	public function __construct()
	{  
			$settings = DB::table('settings')->get();
			foreach ($settings as $value) {
				if($value->param == 'tution_fee'){
					$tution_fees = $value->value;
					}
				if($value->param == 'organization_name'){ 
					$org_name = $value->value;
				}
				if($value->param == 'logo'){ 
					$logo = $value->value;
				}
			}
			View::share(array('tution_fees'=>$tution_fees,'org_name'=>$org_name,'logo'=>$logo));
	}
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}

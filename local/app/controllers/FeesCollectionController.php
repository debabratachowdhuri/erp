<?php

class FeesCollectionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */                                      
		 
	 /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$emp = new Author;
		$emp->name = Input::get('bname');
		$emp->bio = Input::get('bio');
		$emp->save();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return View::make('add');
	}

	public function collect()
	{
		$receiptno = DB::table('fees')->max('receiptno');
		return View::make('feescollection.feescollection', array('receiptno' => $receiptno+1));
	}

	public function getid()
	{
		$sid = Input::get('sid');
		$query =  DB::table('students');
		$query->where('sid', $sid);
		$rows = $query->get();
		return $rows;
	}

	public function getmonth()
	{
		$sid = Input::get('sid');
		$res = DB::table('fees')
                     ->select(DB::raw('max(tomonth) as month'))
                     ->where('sid', $sid)
                     ->get();
		return $res;
	}

	public function collectionstatement()
	{
		$res = DB::table('students')
            ->join('fees', 'students.sid', '=', 'fees.sid')
            ->select('students.sid','students.sec', 'students.name','fees.date','fees.receiptno','fees.class','fees.roll','fees.frommonth','fees.tomonth','fees.fine')
            ->get();

        $month = array(
                  '1'=>'January',
                  '2'=>'February',
                  '3'=>'March',
                  '4'=>'April',
                  '5'=>'May',
                  '6'=>'June',
                  '7'=>'July',
                  '8'=>'August',
                  '9'=>'September',
                  '10'=>'October',
                  '11'=>'November',
                  '12'=>'December'
              );     
		return View::make('feescollection.collection',array('res'=>$res,'month'=>$month));
	}

	public function collecfee()
	{
		$fees = new Fee;

		$fees->sid = Input::get('sid');
		$fees->class = Input::get('class');
		$fees->roll = Input::get('roll');
		$fees->tomonth = Input::get('frommonth');
		$fees->frommonth = Input::get('tomonth');
		$fees->fine = Input::get('fine','0');
		$fees->date = date('Y-m-d');
		
		$fees->save();	
		return Redirect::to('collect');
	}

	public function deletefee()
	{
			$receiptno = Input::get('receiptno');
			DB::table('fees')->where('receiptno', '=', $receiptno)->delete();

	}

	public function customreport()
	{
		$from_date = "";
		$to_date = "";

		$fromdate = date_create(Request::input('frm_dt'));
		if(Request::input('frm_dt') <> NULL)
			$from_date = date_format($fromdate, "Y-m-d");

		$todate = date_create(Request::input('to_dt'));
		if(Request::input('to_dt') <> NULL)
			$to_date = date_format($todate, "Y-m-d");

		$sid = Request::input('sid');
		
		if($sid <> NULL )
		{
			$res = DB::table('students')
		            ->join('fees', 'students.sid', '=', 'fees.sid')
		            ->select('students.sid','students.sec', 'students.name','fees.date','fees.receiptno','fees.class','fees.roll','fees.frommonth','fees.tomonth','fees.fine')
		            ->where('fees.sid', '=', $sid)
		            ->get();
		}
		else {
		if($to_date <> 0) {
				$res = DB::table('students')
		            ->join('fees', 'students.sid', '=', 'fees.sid')
		            ->select('students.sid','students.sec', 'students.name','fees.date','fees.receiptno','fees.class','fees.roll','fees.frommonth','fees.tomonth','fees.fine')
		            ->whereBetween('date', array($from_date,  $to_date))
		            ->get();
          }
         else if($to_date  == NULL && $fromdate <> NULL)
         {
         		$res = DB::table('students')
		            ->join('fees', 'students.sid', '=', 'fees.sid')
		            ->select('students.sid','students.sec', 'students.name','fees.date','fees.receiptno','fees.class','fees.roll','fees.frommonth','fees.tomonth','fees.fine')
		            ->where('date', '=',$from_date)
		            ->get();
         }
         else
         {
         	return Redirect::to('collection');
         }
	}
        $month = array(
                  '1'=>'January',
                  '2'=>'February',
                  '3'=>'March',
                  '4'=>'April',
                  '5'=>'May',
                  '6'=>'June',
                  '7'=>'July',
                  '8'=>'August',
                  '9'=>'September',
                  '10'=>'October',
                  '11'=>'November',
                  '12'=>'December'
              );  

        $todate = "";
        $fromdate = "";
        if(count($res) == 0)
        	return Redirect::to('collection');
        else
        	return View::make('feescollection.collection',array('res'=>$res,'month'=>$month));
	}

	public function dailycollectionstatement()
	{	
		   if(Request::input('mnth')<>null)
		   {
		   	$mnth = Request::input('mnth');	 
		   }
		   else
		   {
		   	$mnth = date('m');
		   }
		   $res = DB::select( DB::raw("SELECT DATE as date, SUM( 230 * (( tomonth - frommonth ) +1) + fine ) as amount
									FROM fees where EXTRACT(MONTH FROM date)  = $mnth
									GROUP BY DATE"));
            
			return View::make('feescollection.dailycollection',array('res'=>$res,'month'=>$mnth));
	}

	public function monthlycollectionstatement()
	{	
		  $res = DB::select( DB::raw("SELECT SUM(fine+230*(1+(tomonth - frommonth))) AS total, 
		  							  DATE_FORMAT(date, '%M') AS mnth FROM fees GROUP BY DATE_FORMAT(date, '%Y-%m')"));
            
			return View::make('feescollection.monthlycollection',array('res'=>$res));
	}


	public function reprint($receipt)
	{
		$month = array(
                  '1'=>'January',
                  '2'=>'February',
                  '3'=>'March',
                  '4'=>'April',
                  '5'=>'May',
                  '6'=>'June',
                  '7'=>'July',
                  '8'=>'August',
                  '9'=>'September',
                  '10'=>'October',
                  '11'=>'November',
                  '12'=>'December'
              );  
		$res = DB::table('students')
		            ->join('fees', 'students.sid', '=', 'fees.sid')
		            ->select('students.sid','students.sec', 'students.name','fees.date','fees.receiptno','fees.class','fees.roll','fees.frommonth','fees.tomonth','fees.fine')
		            ->where('receiptno', '=', $receipt)
		            ->get();
		            
		return View::make('feescollection.reprint_receipt',array("rec" => $res, 'month'=>$month));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}

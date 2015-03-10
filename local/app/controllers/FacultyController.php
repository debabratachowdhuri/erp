<?php
	class FacultyController extends \BaseController {

		public function index()
		{
			  $faculty = Faculty::paginate(20); //for all record
	          return View::make('faculty.index', array('faculty'=>$faculty));
		}

		public function showstudent()
		{
			  $search = Request::input('sid');
			  $student = Student::where('sid','like','%'.$search.'%')->paginate(10);	
			  if(count($student) == 0)
			  	{
			  		$student = Student::where('name','like','%'.$search.'%')->paginate(10);
			  	}
			  if(count($student) == 0)
			  	{
			  		$student = Student::where('class','like','%'.$search.'%')->paginate(10);	
			  	}
  				$student->appends(array('sid' => $search))->links();
  				return View::make('student.index', array('student'=>$student,'search'=>$search));
			 }

		public function deletefaculty()
			{
				$fid = Input::get('fid');
				DB::table('faculties')->where('id', '=', $fid)->delete();
			}

		public function editfaculty()
			{
				$fid = Input::get('fid');	
				$name = Input::get('name');	
				$contact = Input::get('contact');	

				DB::table('faculties')
				->where('id', $fid)
	            ->update(array(
	            		'id'  => $fid,
	            		'name' => $name,
	            		'contactno'=> $contact,
	            		));
				
			}	

		public function addfaculty()
		{
			return View::make('faculty.add');
		}

		public function savefaculty()
		{
			 $faculty = new Faculty;
			 
			 $faculty->name          = Input::get('name');
			 $faculty->contactno     = Input::get('contact_number');
			 $faculty->qualification = Input::get('qualification');
			 $faculty->dob           = Input::get('dob');
			 $faculty->doj           = Input::get('doj');  
			 
			$faculty->save();
			return Redirect::to('/faculty');
		}
	}

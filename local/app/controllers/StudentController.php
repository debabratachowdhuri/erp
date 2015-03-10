<?php
	class StudentController extends \BaseController {

		public function index()
		{
			  $student = Student::paginate(10); //for all record
	          return View::make('student.index', array('student'=>$student));
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

		public function deletestudent()
			{
				$sid = Input::get('sid');
				DB::table('students')->where('sid', '=', $sid)->delete();
				DB::table('fees')->where('sid', '=', $sid)->delete();
			}

		public function editstudent()
			{
				$sid = Input::get('sid');	
				$hsid = Input::get('hsid');	
				$name = Input::get('name');	
				$class = Input::get('class');	
				$section = Input::get('section');	
				$roll = Input::get('roll');	
				DB::table('students')
				->where('sid', $hsid)
	            ->update(array(
	            		'sid'  => $sid,
	            		'name' => $name,
	            		'class'=> $class,
	            		'sec'  => $section,
	            		'roll' => $roll
	            		));
				
			}	

		public function addstudent()
		{
			$lastid = Student::orderBy('sid', 'desc')->first();;
			return View::make('student.add',array('lastid'=>$lastid));
		}

		public function savestudent()
		{
			 $student = new Student;
			 $student->sid      = Input::get('sid');  
			 $student->name     = Input::get('sname');
			 $student->class    = Input::get('sclass');
			 $student->sec      = Input::get('ssec');
			 $student->roll     = Input::get('sroll');
			$student->save();
			return Redirect::to('/addstudent');
		}
	}

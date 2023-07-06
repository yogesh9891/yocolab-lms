<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    //

	public function pending_course()
	{ 

		  $courses = Course::with('user','student')->orderBy('date', 'desc')->get();
		return view('admin.course.pending_course',compact('courses'));
	}

	public function complete_course()
	{
		  $courses = Course::with('user','student','video_class')->orderBy('date', 'desc')->get();
		return view('admin.course.complete_course',compact('courses'));
	}

}

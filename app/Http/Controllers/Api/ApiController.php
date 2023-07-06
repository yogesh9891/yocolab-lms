<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use JWTAuth,Mail,Auth,StdClass,DateTime;

use App\Models\Teacher;
use App\Models\FollowTeacher;
use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\SaveCards;
use App\Models\StudentCourse;
use App\Models\Language;
use App\Models\Country;
use App\Models\Prefrence;
use App\Models\Feedback;
use App\Models\VideoClass;
use App\Models\Faq;
use App\Models\Charge;


class ApiController extends Controller
{
   

    public function language()
    {
       $data = Language::select('name')->whereStatus(1)->get();
         return response()->json([
                    'success' => true,
                    'message' => 'Language List',
                    'data' =>$data,
                ], 200);
    }

    public function country()
    {
        $data = country::select('name','value')->whereStatus(1)->get();
         return response()->json([
                    'success' => true,
                    'message' => 'Conutry List',
                    'data' =>$data,
                ], 200);
    }

     public function category()
    {
        $categories = categories();
        $data = [];

        foreach ($categories as $key => $category) {
            $cat = new StdClass;
            $cat->id = $category->id;
            $cat->name = $category->name;
            $cat->slug = $category->slug;
            $cat->top = $category->top;
            $cat->image = $category->image?asset('storage/img/category/'.$category->image):'';
            $cat->subcategory = [];
            foreach ($category->subcategory as $key2 => $subcategory) {
                
                    $sub = new StdClass;
                    $sub->id = $subcategory->id;
                    $sub->name = $subcategory->name;
                    $sub->slug = $subcategory->slug;
                    $sub->top = $subcategory->top;
                     // $sub->image = asset('storage/category/'.$subcategory->image);
                     $cat->subcategory[$key2]= $sub;
            }

            $data[$key] = $cat;

        }

       
         return response()->json([
                    'success' => true,
                    'message' => 'Category List',
                    'data' =>$data,
                ], 200);
    }

  public function category_show($slug)
    {
        $category =Category::with('subcategory')->where('slug',$slug)->first();
    

        
            $cat = new StdClass;
            $cat->id = $category->id;
            $cat->name = $category->name;
            $cat->slug = $category->slug;
            $cat->top = $category->top;
            $cat->image = $category->image?asset('storage/img/category/'.$category->image):'';
            $cat->subcategory = [];
            foreach ($category->subcategory as $key2 => $subcategory) {
                
                    $sub = new StdClass;
                    $sub->id = $subcategory->id;
                    $sub->name = $subcategory->name;
                    $sub->slug = $subcategory->slug;
                    $sub->top = $subcategory->top;
                     // $sub->image = asset('storage/category/'.$subcategory->image);
                     $cat->subcategory[$key2]= $sub;
            }

        

       
         return response()->json([
                    'success' => true,
                    'message' => 'Category Subcategory List',
                    'data' =>$cat,
                ], 200);
    }

    public function instructors()
    {
        $teachers = Teacher::where('status',1)->orderBy('created_at','DESC')->get();
        $teacher_data = [];
        foreach($teachers as $key => $teacher){

            $teacher_det = teacherDetail($teacher->user_id);
            $teacher_profile = teacher_profile($teacher->user_id);
            $data = new StdClass;
            $data->name = $teacher_det->user?$teacher_det->user->name:'';
            $data->expert = $teacher->expert;
            $data->experience = $teacher->experience;
            $data->image = asset('storage/teacher/'.$teacher->image);
            $data->country = $teacher_det->country;
            $data->followers = $teacher_profile->followers;
            $data->rating = intval(round($teacher_det->rating));
            $data->url = url('/api/instructor-profile/'.$teacher->teacher_id);
            array_push($teacher_data, $data);

        }

            return response()->json([
                    'success' => true,
                    'message' => 'Instructor  List',
                    'data' =>$teacher_data,
                ], 200);
    }



      public function top_courses()
    {
        $timezone = request()->header('timezone');
        if(!$timezone){
             return response()->json([
                    'success' => false,
                    'message' => 'Timezone not found ',
               
                ], 400);
        }

        $courses =Course::with('video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('status',1)->where('date','<=',date('Y-m-d H:i:s'))->orderBy('date','desc')->take(8)->get();
        $course_data = [];
    
        $p = 1;
        foreach($courses as $key => $course){


            $teach = teacherDetail($course->user_id);
            if($teach){

                $time2 = date('H:i',  strtotime($course->time) + $course->duration*3600);
                $date=date_create($course->date);
                $date =date_format($date,"Y-m-d");
                $dat = new DateTime($date.' '.$time2);
                $timezone = timezone($course,$timezone);
                    // if((new DateTime('now') <= $dat ) && ($p <=8)){ 
                        $p++;

                    $data = new StdClass;
                    $data->title = $course->title;
                    $data->image = asset('storage/course/'.$course->image);
                    $data->date =  $timezone->date; 
                    $data->time = $timezone->time;
                    $data->instructor = $teach->user->name;
                    $data->rating = $teach->rating;
                    $data->slug = $course->slug;
                    $data->students = studentEnrolled($course->id);
                    $data->price = currency_convert($course)->html;
                    $data->url = url('class/'.$course->slug);


                    array_push($course_data, $data);

                    // }
                     

              }

        }
      
            return response()->json([
                    'success' => true,
                    'message' => 'Top courses  List',
                    'data' =>$course_data,
                ], 200);
    }



      public function today_courses()
    {
        $timezone = request()->header('timezone');
         if(!$timezone){
             return response()->json([
                    'success' => false,
                    'message' => 'Timezone not found ',
               
                ], 400);
        }

        $courses =Course::with('video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('status',1)->where('date','<=',date('Y-m-d'))->orderBy('date','asc')->take(8)->get();
        $course_data = [];
    
        $p = 1;
        foreach($courses as $key => $course){


            $teach = teacherDetail($course->user_id);
            if($teach){

                $time2 = date('H:i',  strtotime($course->time) + $course->duration*3600);
                $date=date_create($course->date);
                $date =date_format($date,"Y-m-d");
                $dat = new DateTime($date.' '.$time2);
                $timezone = timezone($course,$timezone);
                    // if((new DateTime('now') <= $dat ) && ($p <=8)){ 
                        $p++;

                    $data = new StdClass;
                    $data->title = $course->title;
                    $data->image = asset('storage/course/'.$course->image);
                    $data->date =  $timezone->date; 
                    $data->time = $timezone->time;
                    $data->instructor = $teach->user->name;
                    $data->rating = $teach->rating;
                    $data->slug = $course->slug;
                    $data->students = studentEnrolled($course->id);
                    $data->price = currency_convert($course);
                    $data->url = url('class/'.$course->slug);


                    array_push($course_data, $data);

                    // }
                     

              }

        }
      
            return response()->json([
                    'success' => true,
                    'message' => 'Today courses  List',
                    'data' =>$course_data,
                ], 200);
    }
   
   public function instructor_profile($t_id)
   {
       $teacher = Teacher::where('teacher_id',$t_id)->first();
       
        if(!$teacher){
              return response()->json([
                    'success' => false,
                    'message' => 'You are not register as teacher.',
                ], 400);

               }

               $teacher_det = teacherDetail($teacher->user_id);
                $data = new StdClass;

                $data->name = $teacher_det->user->name;
               
                $data->teacher_id = $teacher->teacher_id;
                $data->expert = $teacher_det->expert;
                $data->qualification = $teacher_det->qualification;
                $data->experience = $teacher_det->experience;
                $data->country = $teacher_det->country;
                $data->date = $teacher_det->date;
                $data->language = $teacher_det->language;
                $data->about = $teacher_det->about;
                $data->image = asset('storage/teacher/'.$teacher_det->image);
             
                $d = teacher_profile($teacher->user_id);
                $data->students = $d->students;
                $data->followers = $d->followers;
                $data->total_courses = $d->course;
                $data->reviews = $d->reviewa;
                $data->courses = [];
                $data->rating = intval(round($d->rating));
                 $courses =Course::with('category','video_class')->whereHas('video_class', function($query) {
                                        $query->where('status', '=', 'start');
                                   })->where('date','>=', date('Y-m-d'))->where('status',1)->where('user_id',$teacher->user_id)->orderBy('date','asc')->get();
                     
                    if($courses){

                         $i = 0;
                         foreach ($courses as $value) {
                             
                                $time = date('H:i',  strtotime($value->time) + $value->duration*3600);
                                 $rating = Feedback::where('course_id',$value->id)->avg('star');
                                 if(!$rating){
                                    $rating = 0;
                                 }
                                 $timezone = timezone($value);
                                 $c_date1 = $timezone->date; 
                                 $c_time1 = $timezone->time;

                                 if(($time >= date('H:i') )){
                                    $course = new StdClass;
                                    $course->title = $value->title;
                                    $course->slug = $value->slug;
                                    $course->url = url('/class/'.$value->slug);
                                    $course->rating = intval(round($rating));
                                    $course->teacher_rating = intval(round($d->rating));
                                    $course->date = $c_date1;
                                    $course->time = $c_time1;
                                    $course->students = studentEnrolled($value->id);
                                    $course->price = currency_convert($value);
                                    $course->image = asset('storage/course/'.$value->image);

                                    $data->courses[$i] = $course;
                                    $i++;
                                 }
                         }   
                    } else {
                        $data->courses = null;
                    }
                
           
                   return response()->json([
                    'success' => true,
                    'message' => 'Instructor profile Successfully',
                    'data' =>$data,
                ], 200);

   }


   public function class_details($slug)
   {
       $course = Course::where('slug',$slug)->first();
        if(!$course){

             return response()->json([
                    'success' => false,
                    'message' => 'Course not found.',
                ], 400);
        }


        $data = new StdClass;

        $timezone = timezone($course);
        $c_date = $timezone->date;
        $c_time = $timezone->time;

        $teacher_det = teacherDetail($course->user_id);

        $data->id = $course->id;
        $data->title = $course->title;
        $data->teacher = new StdClass;

         $data->teacher->name = $teacher_det->user->name;
         $data->teacher->slug = $teacher_det->teacher_id;
         $data->teacher->rating = intval(round($teacher_det->rating));
         $data->teacher->image = asset('storage/teacher/'.$teacher_det->image);
         $data->teacher->url = url('/api/instructor-profile/'.$teacher_det->teacher_id);
        

        $data->slug = $course->slug;
        $data->level = $course->level;
        $data->students = studentEnrolled($course->id);
        $data->class_size = $course->students;
        $data->category = Category::select('id','name')->find($course->category_id);
        $data->tags = explode(',',$course->tags);
        $data->language = $course->language;
        $data->desciption = $course->desciption;
        $data->learn = explode(';', $course->learn);
        $data->requirement = explode(';', $course->requirement);
        $data->currency = $course->currency;
        $data->price =  currency_convert($course);
        $data->date = $c_date;
        $data->time = $c_time;
        $data->is_wishlist = false;
        $data->duration = $course->duration;
        // $data->material = explode(';', $course->material_id);
        $data->image = asset('storage/course/'.$course->image);

        $data->preview = $course->preview?asset('storage/course/'.$course->preview):null;
        $data->youtube = $course->url;
        
          return response()->json([
                    'success' => true,
                    'data' =>$data,
                ], 200);
   }
}

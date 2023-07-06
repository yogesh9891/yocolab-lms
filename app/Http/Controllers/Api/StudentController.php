<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use JWTAuth,Mail,Auth,StdClass,Notification;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Course;
use App\Models\StudentCourse;
use App\Models\FollowTeacher;
use App\Models\VideoClass;
use App\Models\Report;
use App\Models\Charge;
use App\Models\Feedback;

use App\Notifications\StudentNotification;
use App\Notifications\SendNotification;

class StudentController extends Controller
{
   
    public function instructor_register(Request $request)
    {
           $validated = $request->validate([
                   'image' => 'image',
                ],['image.image'=>'Profile image is invalid']);


            $user = Auth::user();
            $teacher = Teacher::where('user_id',$user->id)->first();

            if($teacher){

                return response()->json([
                    'success' => false,
                    'message' => 'You already register as teacher',
                ], 400);


            } else {

             $teacher = new Teacher;
            $teacher->user_id = $user->id;
            $teacher->teacher_id = generateRandomString();
            $teacher->expert = $request->expert;
            $teacher->qualification = $request->qualification;
            $teacher->experience = $request->experience;
            $teacher->country = $request->country;
            $teacher->language = $request->language;
            $teacher->about = $request->about;
            if($request->hasFile('image')){

             $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move('storage/teacher', $imageName);;
                 
                 $teacher->image = $imageName;
            }

            $teacher->save();
    
            $user->update();
  
            $user->assignRole('teacher');

  
        $details = [
            'n_title' => 'Welcome to Yocolab',
            'title' => 'Congratulations '.$user->name.' ! You are an Instructor now!',
            'message' => 'Thank you for using yocolab.com!',
            'actionURL' => url('teacher/profile/'),
        ];
  
        Notification::send($user, new SendNotification($details));
         \Mail::to($user->email)->send(new \App\Mail\BecomeTeacher );
            

                $data = new StdClass;

                $data->name = $user->name;
                $data->email = $user->email;
                $data->teacher_id = $teacher->teacher_id;
                $data->expert = $request->expert;
                $data->qualification = $request->qualification;
                $data->experience = $request->experience;
                $data->country = $request->country;
                $data->language = $request->language;
                $data->about = $request->about;
                $data->image = asset('storage/teacher/'.$teacher->image);

                return response()->json([
                    'success' => true,
                    'message' => 'Congratulations for becoming an Instructor!',
                    'data' => $data,
                ], 200);

            }

    }

    public function user_profile()
    {
        $user = User::find(Auth::id());
        if(!$user){
              return response()->json([
                    'success' => false,
                    'message' => 'USer not Found',
                ], 400);
        }


        $data = new StdClass;
        $name = explode(' ',$user->name);
        $data->first_name = $name[0];
        if($name > 1){
            
        $data->last_name = $name[1];
        }
        $data->email = $user->email;
        $data->phone = $user->phone;
           return response()->json([
                    'success' => true,
                    'message' => 'User Profile',
                    'data' => $data,
                ], 200);
    }


    public function user_update(Request $request)
    {
          $user = User::find(Auth::id());
        if(!$user){
              return response()->json([
                    'success' => false,
                    'message' => 'USer not Found',
                ], 400);
        }

        $user->name = $request->fname.' '.$request->lname;
        $user->phone = $request->phone;
        $user->update();
             return response()->json([
                    'success' => true,
                    'message' => 'User Profile Update Successfully',
                ], 200);


    }

    public function user_dashboard()
    {
       
        $students = StudentCourse::where('user_id',Auth::user()->id)->where('status','done')->count();
            $teacher = FollowTeacher::where('user_id',Auth::user()->id)->count();
            $bookmark = Cart::where('user_id',Auth::user()->id)->count();
             $recent_courses = StudentCourse::with('course','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->whereHas('course', function($query) {
                  $query->where('date', '>=', date('Y-m-d'));
             })->where(['user_id'=>Auth::user()->id,'type'=>'Live','status'=>'done'])->get();

                $data = new StdClass;
                $data->total_course = $students;
                $data->total_followed_teacher = $teacher;
                $data->total_bookmark = $bookmark;
                 $data->courses = [];        

           
                $i = 0;
             foreach ($recent_courses as $key => $item) {
                    if($item->course){

                    $time = date('H:i',  strtotime($item->course->time) + $item->course->duration*3600);
                                 $rating = Feedback::where('course_id',$item->course->id)->avg('star');
                                 if(!$rating){
                                    $rating = 0;
                                 }

                                  $d = teacherDetail($item->course->user_id);

                                 $timezone = timezone($item->course);
                                 $c_date1 = $timezone->date; 
                                 $c_time1 = $timezone->time;
                                if(($time >= date('H:i') )){
                                    $course = new StdClass;
                                    $course->title = $item->course->title;
                                    $course->url = url('/class/'.$item->course->slug);
                                    $course->rating = intval(round($rating));
                                    $course->teacher_rating = intval(round($d->rating));
                                    $course->teacher_name = $d->user->name;
                                    $course->date = $c_date1;
                                    $course->time = $c_time1;
                                    $course->students = studentEnrolled($item->course->id);
                                    $course->price = currency_convert($item->course);
                                    $course->image = asset('storage/course/'.$item->course->image);
                                    $course->status = $item->course->status;

                                    $data->courses[$i] = $course;
                                    $i++;
                                 }
                    }
             }



                return response()->json([
                    'success' => true,
                    'message' => 'User dashboard!',
                    'data' => $data,
                ], 200);



    }

    public function my_course()
    {
       $stu_courses = StudentCourse::with('teacher_details','teacher','course','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->whereHas('course', function($query) {
                  $query->where('date', '>=', date('Y-m-d'));
             })->where('user_id',Auth::user()->id)->where('status','done')->get();


                $data = new StdClass;
                 $data->courses = [];        

           
                $i = 0;
             foreach ($stu_courses as $key => $item) {
                    if($item->course){

                    $time = date('H:i',  strtotime($item->course->time) + $item->course->duration*3600);
                                 $rating = Feedback::where('course_id',$item->course->id)->avg('star');
                                 if(!$rating){
                                    $rating = 0;
                                 }
                                  $d = teacherDetail($item->course->user_id);

                                 $timezone = timezone($item->course);
                                 $c_date1 = $timezone->date; 
                                 $c_time1 = $timezone->time;
                                if(($time >= date('H:i') )){
                                    $course = new StdClass;
                                    $course->title = $item->course->title;
                                    $course->url = url('/class/'.$item->course->slug);
                                    $course->rating = intval(round($rating));
                                    $course->teacher_rating = intval(round($d->rating));
                                    $course->teacher_name = $d->user->name;
                                    $course->date = $c_date1;
                                    $course->time = $c_time1;
                                    $course->students = studentEnrolled($item->course->id);
                                    $course->price = currency_convert($item->course);
                                    $course->image = asset('storage/course/'.$item->course->image);
                                    $course->status = $item->course->status;

                                    $data->courses[$i] = $course;
                                    $i++;
                                 }
                    }
             }

               return response()->json([
                    'success' => true,
                    'message' => 'User upcoming courses !',
                    'data' => $data,
                ], 200);

    }

    public function orders()
    {

      $stu_courses = StudentCourse::with('course')->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();


                $data = new StdClass;
                 $data->courses = [];        

           
                $i = 0;
             foreach ($stu_courses as $key => $item) {
                    if($item->course){

                    $time = date('H:i',  strtotime($item->course->time) + $item->course->duration*3600);
                                 $rating = Feedback::where('course_id',$item->course->id)->avg('star');
                                 if(!$rating){
                                    $rating = 0;
                                 }

                                 $d = teacherDetail($item->course->user_id);
                                 $timezone = timezone($item->course);
                                 $c_date1 = $timezone->date; 
                                 $c_time1 = $timezone->time;
                                if(($time >= date('H:i') )){
                                    $course = new StdClass;
                                    $course->title = $item->course->title;
                                    $course->url = url('/class/'.$item->course->slug);
                                    $course->teacher_rating = intval(round($d->rating));
                                    $course->teacher_name = $d->user->name;
                                    $course->date = $c_date1;
                                    $course->time = $c_time1;
                                    $course->students = studentEnrolled($item->course->id);
                                    $course->price = currency_convert($item->course);
                                    $course->image = asset('storage/course/'.$item->course->image);
                                    $course->status = $item->course->status==1?true:false;
                                    $course->student_status = $item->status=='done'?true:false;

                                    $data->courses[$i] = $course;
                                    $i++;
                                 }
                    }
             }

               return response()->json([
                    'success' => true,
                    'message' => 'User order history !',
                    'data' => $data,
                ], 200);
    }

    public function teachers()
    {
        $teachers = FollowTeacher::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
          return response()->json([
                    'success' => true,
                    'message' => 'User order history !',
                    'data' => $teachers,
                ], 200);
        
    }


     public function wishlist()
    {
            // $stu_courses = Cart::select('id','user_id','course_id')->with('course')->whereHas('course', function($query) {
            //       // // $query->where('date', '>=', date('Y-m-d'));
            //       $query->select('id','title','slug','image');
            //  })->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();

         $stu_courses = Cart::select('id','user_id','course_id')->with('course:id,user_id,title,slug,image')->where('user_id',Auth::user()->id)->whereHas('course', function($query) {

          // $query->where('date', '>=', date('Y-m-d'))->where('status',1);

         })->orderBy('created_at','DESC')->get();
                 foreach ($stu_courses as $key => $item) {
                         $d = teacherDetail($item->user_id);

                        if($item->course){
                            $item->course->image = asset('storage/course/'.$item->course->image);
                             $item->course->teacher_name = $d->user->name;
                            $item->course->price = currency_convert($item->course);
                            
                        }
                    }

               return response()->json([
                    'success' => true,
                    'message' => 'User wishlist  !',
                    'data' => $stu_courses,
                ], 200);
       
    }


   public function add_wishlist($course_id)
    {

        $course = Course::findOrFail($course_id);
         $cart = Cart::firstOrCreate([
        'course_id' => $course_id,
        'user_id'=>Auth::id(),
            ]);
       $cart->user_id = Auth::id();
       $cart->course_id = $course_id;
       $cart->save();
         return response()->json([
                    'success' => true,
                    'message' => 'Course added into wishlist  !',
                 
                ], 200);
    } 

    public function remove_wishlist($id)
    {
       $cart =Cart::findOrFail($id);
       $cart->destroy($id);
              return response()->json([
                    'success' => true,
                    'message' => 'Course deleted from wishlist  !',
                 
                ], 200);
    }

}

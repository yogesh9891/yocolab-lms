<?php

namespace App\Http\Controllers\Api;

use JWTAuth,Mail,Auth,StdClass,Notification,DateTime,DateTimeZone;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Studymaterial;
use App\Models\SaveCards;
use App\Models\VideoClass;
use App\Models\Charge;
use App\Models\StudentCourse;
use App\Models\FollowTeacher;
use App\Models\ZoomId;
use App\Models\Feedback;
use App\Models\Earning;



use App\Notifications\BecomeTeacher;
use App\Notifications\SendNotification;

use Pusher\Pusher;

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;
use OpenTok\Role;
use OpenTok\Session;


class InstructorController extends Controller
{

   public $zoom_id ;
    

    public function edit_profile(Request $request)
    {
       

        $user  = User::find(Auth::id());
        $teacher = Teacher::with('user','course')->where('user_id',$user->id)->first();


          if(!$teacher){
              return response()->json([
                    'success' => false,
                    'message' => 'You are not register as teacher.',
                ], 400);

               }


            $teacher->expert = $request->expert;
            $teacher->qualification = $request->qualification;
            $teacher->experience = $request->experience;
            $teacher->country = $request->country;
            $teacher->language = $request->language;
            $teacher->about =  $request->about;
            if($request->hasFile('image')){

             $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move('storage/teacher', $imageName);;
                 
                 $teacher->image = $imageName;
            }

            $teacher->update();
            $user->name = $request->name;
            $user->update();

            return response()->json([
                    'success' => true,
                    'message' => 'Instructor Updated Successfully',
                ], 200);
        
    }

    public function profile(Request $request)
    {

        
      $teacher = Teacher::where('user_id',Auth::id())->first();
       
        if(!$teacher){
              return response()->json([
                    'success' => false,
                    'message' => 'You are not register as teacher.',
                ], 400);

               }

                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));


               $teacher_det = teacherDetail($teacher->user_id);
                $data = new StdClass;
                  $bank_account = new StdClass;
                  $customer_cards = new StdClass;
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
                $data->currency = null;

                if($teacher->account_id){

                $bank =   $stripe->accounts->allExternalAccounts(
                        $teacher->account_id,
                        ['object' => 'bank_account', 'limit' => 1]
                      );
                        $bank_account->account_name = $bank->data[0]->account_holder_name;
                        $bank_account->account_type = $bank->data[0]->account_holder_type;
                        $bank_account->currency = $bank->data[0]->currency;
                        $bank_account->last4 = $bank->data[0]->last4;
                        $bank_account->bank_name = $bank->data[0]->bank_name;
                        $data->currency = $bank->data[0]->currency;

                  }

                  $saved_cards = SaveCards::where('user_id',$teacher->user_id)->first();
                   if($saved_cards){

                       $customer =$stripe->customers->retrieve($saved_cards->customer_id);
                        $customer_cards = $customer->sources;

                     }


              
                $data->bank_account= $bank_account;
                $data->customer_cards= $customer_cards;
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
                                    $course->url = url('api/class/'.$value->slug);
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

    public function material(Request $request)
    {


        $teacher = Teacher::where('user_id',Auth::id())->first();
         $material = Studymaterial::where('user_id',$teacher->user_id)->get();
         $teacher_material = [];;

         foreach($material as $key => $item){
            $m =new StdClass;
            $m->id = $item->id;
            $m->title = $item->title;
            $m->file = asset('storage/material/'.$item->file);
            $teacher_material[$key] = $m;
         }
            return response()->json([
                    'success' => true,
                    'message' => 'Instructor material Successfully',
                    'data' =>$teacher_material,
                ], 200);
    }

     public function material_store(Request $request)
    {
        $teacher = Teacher::where('user_id',Auth::id())->first();
        if(!$teacher){
             return response()->json([
                    'success' => false,
                    'message' => 'You are not register as teacher.',
                ], 400);
        }
       
        $material = new Studymaterial;
        $material->user_id =$teacher->user_id;
        $material->title = $request->title;

         if($request->hasFile('file')){

             $imageName = time().'.'.request()->file->getClientOriginalExtension();

                request()->file->move(public_path('storage/material'), $imageName);

                 
                 $material->file = $imageName;
            }



        $material->save();

           $data = new StdClass;
        $data->id = $material->id;
        $data->title = $material->title;
        $data->file = asset('storage/material/'.$material->file);

         return response()->json([
                    'success' => true,
                    'message' => ' material stored Successfully',
                    'data' =>$data,
                ], 200);
    }

    public function material_show($id)
    {
        $material = Studymaterial::where('user_id',Auth::id())->where('id',$id)->first();
        if(!$material){
             return response()->json([
                    'success' => false,
                    'message' => 'You are not register as teacher.',
                ], 400);
        }

        $data = new StdClass;
        $data->id = $material->id;
        $data->title = $material->title;
        $data->file = asset('storage/material/'.$material->file);

         return response()->json([
                    'success' => true,
                    'message' => 'Instructor material Successfully',
                    'data' =>$data,
                ], 200);

    }


    public function material_update(Request $request,$id)
    {
        $material = Studymaterial::where('user_id',Auth::id())->where('id',$id)->first();
        if(!$material){
             return response()->json([
                    'success' => false,
                    'message' => 'You are not register as teacher.',
                ], 400);
        }


        $material->title = $request->title;

         if($request->hasFile('file')){

             $imageName = time().'.'.request()->file->getClientOriginalExtension();

                request()->file->move(public_path('storage/material'), $imageName);

                 
                 $material->file = $imageName;
            }



        $material->update();

           $data = new StdClass;
        $data->id = $material->id;
        $data->title = $material->title;
        $data->file = asset('storage/material/'.$material->file);

         return response()->json([
                    'success' => true,
                    'message' => ' material updated Successfully',
                    'data' =>$data,
                ], 200);
    }

  public function getZoomIds($id)
    {
          $video_class = VideoClass::select('zoom_app_id')->where('zoom_app_id','!=',null)->orderBy('id','desc')->get()->take(9)->toArray();
        $v = array_map('array_shift', $video_class);
          if(in_array($id, $v)){
          return false;
      } else {
        return true;
      }
    }


         public function generateZoomToken()
{

   $zid= 0;
     $zoom =  ZoomId::all();

     foreach ($zoom as  $value) {
        $zid =  $this->getZoomIds($value->id);
        if($zid){
            $zid = $value->id;
          
            break;
        }
     }

$z = ZoomId::find($zid);

$key = $z->app_id;
     $this->zoom_id = $z->id;
     // $key='QGJL2X69RnuEI0IAJ4YVuA';
     // $secret='0VowUkOvWn7lAc2AzebjQjrmayNcznMu9iaz';
$secret = $z->secret;
    // $key = env('ZOOM_CLIENT_KEY', '');
    // $secret = env('ZOOM_CLIENT_SECRET', '');
    $payload = [
        'iss' => $key,
        'exp' => strtotime('+1 minute'),
    ];
    return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
}



public function zoomRequest()
{
    $jwt = $this->generateZoomToken();
    return \Illuminate\Support\Facades\Http::withHeaders([
        'authorization' => 'Bearer ' . $jwt,
        'content-type' => 'application/json',
    ]);
}

public function retrieveZoomUrl()
{
    return env('ZOOM_API_URL', '');
}

public function zoomPost(string $path, array $body = [])
{
    $url = $this->retrieveZoomUrl();
    $request = $this->zoomRequest();
    return $request->post($url.$path, $body);
}


    public function create_class(Request $request)
    {
       

    
          $user = Auth::user();
             $teacher = Teacher::with('user')->where('user_id',$user->id)->first();
           if(!$teacher){
           return response()->json([
                    'success' => false,
                    'message' => 'You are not register as teacher.',
                ], 400);
        }

  // return response()->json([
  //                   'success' => false,
  //                   'message' => $request->all(),
  //               ], 200);
        
try {

         $data = new Course ;

         $teacher_det = teacherDetail($user->id);
        $data->user_id = $user->id;
        $data->title = $request->title;
        $data->type = 'Live';
        $data->price_type = $request->type;
        $data->category_id = $request->category_id;
       
        $data->level = $request->level;
         $data->students = $request->students;
         $data->timezone = $request->timezone;
  
        $data->tags = implode(',', $request->tags);
        $data->desciption = $request->description;
        
        $data->language = $request->language;
        $slug=str_slug($data->title);
        $request->slug = $slug;
      $data->material_id = implode(';', $request->material);   
        $data->currency = $request->currency;
        $data->price = $request->price;
        $data->discount = $request->discount;
        $data->learn = implode(';', $request->learn);
        $data->requirement = implode(';', $request->requirement);
          $a = explode('?v=', $request->video_url);
        if(count($a) >1){
        $b = explode('&', $a[1]);
        $data->url = 'https://www.youtube.com/embed/'.$b[0];
      }

        if($request->price){
                  $data->currency = $teacher_det->currency; 
                  
                }
      

        if($request->hasFile('image')){

             $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move(public_path('storage/course'), $imageName);;
                 
                 $data->image = $imageName;
            }


         if($request->hasFile('preview_video')){

             $imageName = time().'.'.request()->preview_video->getClientOriginalExtension();

                request()->preview_video->move(public_path('storage/video'), $imageName);

                 
                 $data->preview = $imageName;
            }

              if($request->hasFile('video')){

             $imageName = time().'.'.request()->video->getClientOriginalExtension();

                request()->video->move(public_path('storage/video'), $imageName);

                 
                 $data->video = $imageName;
            }

            if(count($request->date) > 1){


                // Multiple date and time


           foreach ($request->date as $key => $value) {


              $timzezone_time=DateTime::createFromFormat('d/m/Y H:i', $value.' '.$request->time[$key], new DateTimeZone($request->timezone));
              
                $utc_date = clone $timzezone_time; 
                $utc_date->setTimeZone(new DateTimeZone('UTC'));
        
                if($request->price){
                  $duration =  $request->duration[$key];

                }
                  else {
                    $duration = 0.4;
                  }
                  $date =  $utc_date->format('Y-m-d H:i:s');
                  $zoom_date =   $utc_date->format('d M Y');
                  $time =   $utc_date->format('H:i:s');

                $new =  $data->replicate()->fill([
                      'slug'=>$slug.'-'.generateRandomString(),
                      'date' => $date,
                      'time' => $time,
                      'duration' => $duration,
                  ]);
                  $new->save();

                   $id = $new->id;
                   $slug = $new->slug;
                

                    if(!$request->price) {
                                       $path = 'users/me/meetings';
                                        $response = $this->zoomPost($path, [
                                          'topic' => $request->title,
                                          'type' => 2,
                                          'start_time' => $zoom_date.'T'.$request->time[$key],
                                          'duration' => 40,
                                          'agenda' =>'this is agendfa',
                                          'settings' => [
                                              'host_video' => true,
                                              'participant_video' => false,
                                              'waiting_room' => true,
                                              'allow_multiple_devices' => true,
                                          ]
                                      ]);

                                    $data1  =     json_decode($response->body(), true);
                                    $class = new VideoClass;
                                    $class->course_id = $id;
                                    $class->name = $request->title;
                                    $class->slug = str_slug($request->title).'-'.generateRandomString();
                                    $class->user_id =$teacher->user->id;
                                    $class->zoom_app_id = $this->zoom_id;
                                    $class->zoom_url = $data1['join_url'];
                                    $class->zoom_id = $data1['id'];
                                    $class->zoom_time = $data1['start_time'];
                                    $class->zoom_password = $data1['encrypted_password'];
                                    $class->save();

                                    } else {


            
                                       $apiObj = new OpenTok(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
                                           $session = $apiObj->createSession( array(
                                            'archiveMode' => ArchiveMode::ALWAYS,
                                            'mediaMode' => MediaMode::ROUTED
                                        ));

                                  
                                      $class = new VideoClass();
                                      // Generate a name based on the name the teacher entered
                                      $class->name = $request->title . " class";
                                         $class->slug = str_slug($request->title).'-'.generateRandomString();
                                      $class->course_id = $id;
                                       $class->user_id =$teacher->user->id;
                                      // $class->user_id = $user->id;
                                      // Store the unique ID of the session
                                      $class->session_id = $session->getSessionId();
                                      // Save this class as a relationship to the teacher
                                       $user->myClass()->save($class);
                                      $class->save();
                                    }

                   }

                } else{

              // dd($request->date[0], $request->time[0], $request->timezone);
                $timzezone_time=DateTime::createFromFormat('d/m/Y H:i', $request->date[0].' '.$request->time[0], new DateTimeZone($request->timezone));
            
                $utc_date = clone $timzezone_time; 

                $utc_date->setTimeZone(new DateTimeZone('UTC'));
                  $date =  $utc_date->format('Y-m-d H:i:s');
                  $zoom_date =   $utc_date->format('d M Y');
                  $time =   $utc_date->format('H:i:s');

                  $duration = 0.4; 

                  if($request->price){
                  $duration =  $request->duration[0];

                }
                  else {
                    $duration = 0.4;
                  }
                  $data->duration = $duration;
                  $data->date = $date;
                  $data->time = $time;
                  $data->slug = $slug.'-'.generateRandomString();
            
               
                   $data->save();
                   $id = $data->id;
                   $slug = $data->slug;
                     if(!$request->price) {
                                       $path = 'users/me/meetings';
                                        $response = $this->zoomPost($path, [
                                          'topic' => $request->title,
                                          'type' => 2,
                                          'start_time' => $zoom_date.'T'.$request->time[0],
                                          'duration' => 40,
                                          'agenda' =>'this is agendfa',
                                          'settings' => [
                                              'host_video' => true,
                                              'participant_video' => false,
                                              'waiting_room' => true,
                                              'allow_multiple_devices' => true,
                                          ]
                                      ]);

                                    $data1  =     json_decode($response->body(), true);
                                    $class = new VideoClass;
                                    $class->course_id = $id;
                                    $class->name = $request->title;
                                    $class->slug = str_slug($request->title).'-'.generateRandomString();
                                    $class->user_id =$teacher->user->id;
                                    $class->zoom_app_id = $this->zoom_id;
                                    $class->zoom_url = $data1['join_url'];
                                    $class->zoom_id = $data1['id'];
                                    $class->zoom_time = $data1['start_time'];
                                    $class->zoom_password = $data1['encrypted_password'];
                                    $class->save();

                                    } else {


            
                                       $apiObj = new OpenTok(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
                                           $session = $apiObj->createSession( array(
                                            'archiveMode' => ArchiveMode::ALWAYS,
                                            'mediaMode' => MediaMode::ROUTED
                                        ));

                                  
                                      $class = new VideoClass();
                                      // Generate a name based on the name the teacher entered
                                      $class->name = $request->title . " class";
                                         $class->slug = str_slug($request->title).'-'.generateRandomString();
                                      $class->course_id = $id;
                                      // $class->user_id = $user->id;
                                      // Store the unique ID of the session
                                      $class->session_id = $session->getSessionId();
                                      // Save this class as a relationship to the teacher
                                       $user->myClass()->save($class);
                                      $class->save();
                               
                                    }


                          
                }


                            $timezone = timezone($data);
                            $curr = currency_convert($data);
                            $c_date = $timezone->date;
                            $c_time = $timezone->time;
                            $d =  teacherDetail(Auth::id());

                             $details = [
                            'subject' => 'New Course Arrived By'.$user->name.'! Yocolab',
                            'heading'=>'New Class on Yocolab!',
                            'description'=>'Your instructor '.ucfirst($d->user->name).' has created a class. You can enroll for this class if it helps.',
                            'id'=>$data->id,
                            'instructor'=>$d->user->name,
                            'title'=>$data->title,
                            'image'=>$data->image,
                            'date'=>$c_date,
                            'time'=>$c_time,
                            'rating'=>intval($d->rating),
                            'price'=>$curr->html,
                            'btn'=>'Enroll Now',
                            'url'=>url('class/'.$slug),
                            
                        ];

                      $detail = [
                                    'n_title' => 'Welcome to Yocolab',
                                    'title'=>'New Course Arrived By'.$user->name,
                                    'title'=>'“'.$user->name. '“ has created a new class.',
                                    'message' => ucfirst(Auth::user()->name).' has created new class '.$data->title,
                                    'actionURL' => url('class/'.$slug),
                                ];
                                        
                          $users = FollowTeacher::where('teacher_id',$user->id)->get();
                          
                          foreach ($users as $item) {
                          
                                   $student = User::find($item->user_id);
                                   if($student){

                                     Notification::send($student, new SendNotification($detail));
                                   \Mail::to($student->email)->send(new \App\Mail\FollowCourseMail($details));
                                   }


                                }
    
} catch (Exception $e) {
      return response()->json([
                    'success' => false,
                    'message' => $e
                  
                ], 400);
}

          
                 return response()->json([
                    'success' => true,
                    'message' => 'Class created Successfully',
                    'url' =>url('class/'.$slug),
                ], 200);


    }



    public function edit_class($slug)
    {
        $course = Course::where('slug',$slug)->where('user_id',Auth::id())->where('status',1)->first();
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

        $data->id = $course->id;
        $data->title = $course->title;
        $data->type = $course->price_type;
        $data->slug = $course->slug;
        $data->level = $course->level;
        $data->students = $course->students;
        $data->category = Category::select('id','name')->find($course->category_id);
        $data->tags = inp(',',$course->tags);
        $data->language = $course->language;
        $data->desciption = $course->desciption;
        $data->requirement = explode(';', $course->requirement);
        $data->learn = explode(';', $course->learn);
        $data->currency = $course->currency;
        $data->price = $course->price;
        $data->discount = $course->discount;
        $data->date = $c_date;
        $data->time = $c_time;
        $data->duration = $course->duration;
        $data->material = explode(';', $course->material);
        $data->image = asset('storage/course/'.$course->image);

        $data->preview = $course->preview?asset('storage/course/'.$course->preview):null;
        $data->youtube = $course->url;
        
          return response()->json([
                    'success' => true,
                    'data' =>$data,
                ], 200);


    }

    public function class_update(Request $request,$slug)
    {
        $data = Course::where('slug',$slug)->where('user_id',Auth::id())->where('status',1)->first();
        if(!$data){

             return response()->json([
                    'success' => false,
                    'message' => 'Course not found.',
                ], 400);
        }



        $data->title = $request->title;
       
        $data->category_id = $request->category_id;
       
        $data->level = $request->level;
         $data->students = $request->students;
        $data->tags = implode(',', $request->tags);
        $data->desciption = $request->description;
        
        $data->language = $request->language;
        $slug=str_slug($request->title);
        $request->slug = $slug;
        $data->learn = implode(';', $request->learn);
        $data->material_id = implode(';', $request->material);
        $data->requirement = implode(';', $request->requirement);
          $a = explode('?v=', $request->video_url);
        if(count($a) >1){
        $b = explode('&', $a[1]);
        $data->url = 'https://www.youtube.com/embed/'.$b[0];
      }

        
      

        if($request->hasFile('image')){

             $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move(public_path('storage/course'), $imageName);;
                 
                 $data->image = $imageName;
            }


         if($request->hasFile('preview_video')){

             $imageName = time().'.'.request()->preview_video->getClientOriginalExtension();

                request()->preview_video->move(public_path('storage/video'), $imageName);

                 
                 $data->preview = $imageName;
            }

              if($request->hasFile('video')){

             $imageName = time().'.'.request()->video->getClientOriginalExtension();

                request()->video->move(public_path('storage/video'), $imageName);

                 
                 $data->video = $imageName;
            }

            $data->update();
              return response()->json([
                    'success' => true,
                    'message' =>'class updated Successfully',
                ], 200);

        
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VideoClass;
use App\Models\Course;
use App\Models\StudentCourse;

use App\Models\User;

use Pusher\Pusher;

#Import necessary classes from the Vonage API (AKA OpenTok)

use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\Role;
use OpenTok\Session;
use Auth;

class VideoClassContoller extends Controller
{


    public function createClass(Request $request)
    {
        // Get the currently signed-in user
        $user = $request->user();
        // Throw 403 if student tries to create a class
       
     
        
         $apiObj = new OpenTok(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
    $session = $apiObj->createSession(array('mediaMode' => MediaMode::ROUTED));

    
        $class = new VideoClass();
        // Generate a name based on the name the teacher entered
        $class->name =time()." class";
        // Store the unique ID of the session
        $class->session_id = $session->getSessionId();
        // Save this class as a relationship to the teacher
        $user->myClass()->save($class);

         $token = $opentok->generateToken($sessionId, ['role' => Role::PUBLISHER, 'expireTime' => time() + ($course->duration*60*60),'data' =>  $connectionMetaData,'initialLayoutClassList' => array('focus')]);  
        $virtualClass->status ='inprogress';
        $virtualClass->token =$token;
        $virtualClass->user_name =Auth::user()->name;
        $virtualClass->save();
        
        // Send the teacher to the classroom where real-time video goes on
        return redirect()->route('classroom', ['id' => $class->id]);
    }

    public function showClassRoom($slug)
    {

         

        $course = Course::where('slug',$slug)->where('status',1)->first();
        if(!$course){
            abort(404);
        }
        // Get the currently authenticated user

        $user = Auth::user();
        // Find the virtual class associated by provided id
        $virtualClass = VideoClass::where('course_id',$course->id)->first();  
         if(!$virtualClass){
            abort(404);
        }  
        $course_id = $virtualClass->course_id;
        // Gets the session ID
        $sessionId = $virtualClass->session_id;
        $course->class_id = $virtualClass->id;
        // Instantiates new OpenTok object
        $opentok = new OpenTok(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
        $connectionMetaData = "username=".$user->name;
       // Generates token for client as a publisher that lasts for one week
          // $token = $opentok->generateToken($sessionId, ['role' => Role::PUBLISHER, 'expireTime' => time() + (7 * 24 * 60 * 60),'data' =>  $connectionMetaData,'initialLayoutClassList' => array('focus')]); 
           
        if($virtualClass->status == 'end'){
                 return redirect()->back()->with('error','Meeting is ended');
        }



  if($user->id == $virtualClass->user_id){

        $token = $opentok->generateToken($sessionId, ['role' => Role::PUBLISHER, 'expireTime' => time() + ($course->duration*60*60),'data' =>  $connectionMetaData,'initialLayoutClassList' => array('focus')]);  
        $virtualClass->status ='inprogress';
        $virtualClass->token =$token;
        $virtualClass->user_name =Auth::user()->name;
        $virtualClass->save();



         $options = array(
         'cluster' => env('PUSHER_APP_CLUSTER'),
         'encrypted' => true
         );


        $pusher = new Pusher(
         env('PUSHER_APP_KEY'),
         env('PUSHER_APP_SECRET'),
         env('PUSHER_APP_ID'), 
         $options
         );
 
        $data['subject'] = '“'.$course->title.'” has started.';
        $data['message'] = '“'.$user->name.'“ has started the class titled “'.$course->title.'“. Join now.';
        $data['course_id'] = $course->id;
        $pusher->trigger('session-join', 'App\\Events\\Notify', $data);

        $course->url = url('/teacher/meeting-end/'.$course->slug);

        $key = $virtualClass->id; 
    $secret ='yocolab';

    $payload = [
        'iss' => $key,
        'access' => 'instructor',
        'url'=>$course->url,
        'exp' => strtotime('+24 hour'),
    ];
    $token =  \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
 $url = 'https://class.yocolab.com:8123/room/'.$course->title.'?token='.$token.'&id='.$course->video_class->id.'&name='.Auth::user()->name;
  return view('vonage-iframe',compact('url'));

 return redirect()->away($url);
      

    }
   else {
      
        $user = User::find(Auth::user()->id);
        $s  = StudentCourse::where('user_id',$user->id)->where('course_id',$course->id)->where('status','done')->first();
        if(!$s){
              return redirect()->back()->with('error','You cannot not join this class');
        }
        $students = explode(';',$virtualClass->student_id);
      
        $virtualClass->save(); 
        // Check User is join this course or not
           if (!in_array($user->id, $students))
              {
                 return redirect()->back()->with('error','You cannot not join this class');
                    
              }

       //Check User is already  Join

        

        if($virtualClass->token == null){
                 return redirect()->back()->with('error','Kindly wait for the instructor to start the class');
        } else {

           $token = $virtualClass->token;
        }
            $course->url = url('user/feedback/'.$course->slug);

         $key = $virtualClass->id; 
    $secret ='yocolab';

    $payload = [
        'iss' => $key,
        'access' => 'student',
        'url'=>$course->url,
        'exp' => strtotime('+24 hour'),
    ];
    $token =  \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
 $url = 'https://class.yocolab.com:8123/room/'.$course->title.'?token='.$token.'&id='.$course->video_class->id.'&name='.Auth::user()->name;

 return view('vonage-iframe',compact('url'));

   }
        // Open the classroom with all needed info for clients to connect
     
 //$token = $opentok->generateToken($sessionId, ['role' => Role::PUBLISHER, 'expireTime' => time() + (7 * 24 * 60 * 60),'data' =>  $connectionMetaData,'initialLayoutClassList' => array('focus')]); 
       return redirect('/');
    }


    public function notification()
    {
                $options = array(
         'cluster' => env('PUSHER_APP_CLUSTER'),
         'encrypted' => true
         );
                $pusher = new Pusher(
         env('PUSHER_APP_KEY'),
         env('PUSHER_APP_SECRET'),
         env('PUSHER_APP_ID'), 
         $options
         );
 
        $data['message'] = 'Hello XpertPhp';
          $data['course_id'] = 126;
        $pusher->trigger('session-join', 'App\\Events\\Notify', $data);
 
    }
}

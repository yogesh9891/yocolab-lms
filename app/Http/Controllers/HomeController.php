<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\VideoClass;;
use App\Models\Course;
use App\Models\ZoomId;
use Hash;
use Auth;
use stdClass;
use DB;

use Pusher\Pusher;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $zoom_id ;
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      /// $user = Auth::user();
   
        $classes = [];

        // If user is a student, give her a list of virtual classes
    ///App id 1

      // Client id  2lciaVqVTxOSglpZZfIsGg
      // Client Sectret  hTZd8DkbJ2WVCCq2h2pQ5Ne487p6NdE6


    //App id 2
            // Client id  tkuYrwmkR8yZK5v8vOiSQ
      // Client Sectret  WqYpERgSEp0PT5R0QjTU9dZv5hKBaFvN
        
   //
           // $classes = VideoClass::orderBy('name', 'asc')->get();
        

     //   return view('home', compact('user', 'classes'));//
         return   redirect('/');
    }



    public function register(Request $request)
    {
        $data = new User;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->password = Hash::make($request->password);
         $user->assignRole('student');
        $data->save();
        return true;
    }

    public function createCourse()
    {
        return view('create-course');
    }

    public function teacherRegister()
    {
        return view('teacher-register');
    }

    public function createClass(Request $request)
    {   
       

         $path = 'users/me/meetings';
      $response = $this->zoomPost($path, [
        'topic' => 'Test',
        'type' => 2,
        'start_time' => '2021-05-0T12:00:00',
        'duration' => 40,
        'agenda' =>'this is agendfa',
        'settings' => [
            'host_video' => true,
            'participant_video' => false,
            'waiting_room' => true,
            'allow_multiple_devices' => true,
        ]
    ]);

$data1 =  json_decode($response->body(), true);
$class = new VideoClass();
 $class->course_id = 444;
                                    $class->name = 'Zoom Paraller Testing';
                                    $class->user_id = Auth::user()->id;
                                    $class->zoom_app_id = $this->zoom_id;
                                    $class->zoom_url = $data1['join_url'];
                                    $class->zoom_id = $data1['id'];
                                    $class->zoom_time = $data1['start_time'];
                                    $class->zoom_password = $data1['encrypted_password'];
                                    $class->save();
return $this->live($class->course_id);
return response()->back();
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
    return $request->post($url . $path, $body);
}

 public function differenceInHours($startdate,$enddate){
    $starttimestamp = strtotime($startdate);
    $endtimestamp = strtotime($enddate);
    $difference = abs($endtimestamp - $starttimestamp)/3600;
    return $difference;
}


public function join()

{

    
 $posts = Course::inRandomOrder()->take(4)->get();

  dd($posts);

    

}

public function live($slug)

{
    $data = new stdClass;
    $course = Course::where('slug',$slug)->first();
    $video =VideoClass::where('course_id',$course->id)->first();
    $data->mn =$video->zoom_id;
    $data->class_id = $video->id;
    $data->title =$video->name;
    $data->password =$video->zoom_password;
    $data->name = Auth::user()->name;
    $data->duration =40;
    if($video->zoom_app_id){

      $zoom = ZoomId::find($video->zoom_app_id);
      $data->APP_ID = $zoom->app_id;
      $data->APP_SECRET = $zoom->secret;
    } 

    else {
        $data->APP_ID = env('ZOOM_CLIENT_KEY');
      $data->APP_SECRET = env('ZOOM_CLIENT_SECRET');
    }    
    if(Auth::user()->id ==$video->user_id){
    	$data->url = url('/teacher/meeting-end/'.$course->slug);
        $data->role= 1;
        $video->status= 'inprogress';
        $video->update();
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
 
        $data1['subject'] = 'Class has started.';
        $data1['message'] = 'Instuctor started the class. You can join now';
        $data1['course_id'] = $course->id;
        $pusher->trigger('session-join', 'App\\Events\\Notify', $data1);




    } else {

         $user = User::find(Auth::user()->id);
        $students = explode(';',$video->student_id);
       if (!in_array($user->id, $students))
              {
                 return redirect()->back()->with('flash_error','You cannot not join this course');
                    
              }
    	$data->url = url('user/feedback/'.$course->slug);
    	 $data->role =0;
    }

    return view('zoom',compact('data'));
}

   
}

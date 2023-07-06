<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

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
use App\Models\Language;
use App\Models\Country;
use App\Models\RequestClass;
use App\Jobs\UpcompingCourse;
use App\Jobs\TeacherAttendClass;


use App\Notifications\BecomeTeacher;
use App\Notifications\SendNotification;

use App\Jobs\TeacherPayment;

use Hash;
use Auth;
use stdClass;
use DB;
use Notification;
use DateTime;
use DateTimeZone;
use Mail;
#Import necessary classes from the Vonage API (AKA OpenTok)
use Pusher\Pusher;
use Carbon\Carbon;

use Razorpay\Api\Api;
use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;
use OpenTok\Role;
use OpenTok\Session;


class TeacherFrontController extends Controller
{


     public $zoom_id ;

   public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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
    
     public function teacherRegister(Request $request)
    { 

    	if($request->isMethod('post')){

              $validated = $request->validate([
                   'image' => 'image',
                ],['image.image'=>'Profile image is invalid']);


    		$user = Auth::user();
    		$teacher = Teacher::where('user_id',$user->id)->first();

    		if($teacher){

    			 return  redirect('/teacher/create-course');

    		} else {

    			$teacher = new Teacher;
    		$teacher->user_id = $user->id;
            $teacher->teacher_id = generateRandomString();
    		$teacher->expert = $request->expert;
    		$teacher->qualification = $request->qualification;
    		$teacher->experience = $request->experience;
    		$teacher->country = $request->country;
    		$teacher->language = $request->language;
    		// $teacher->about = $request->about;
             $textToStore = nl2br(htmlentities($request->decription, ENT_QUOTES, 'UTF-8'));
            $data->desciption  = $textToStore;

    		// $teacher->students = $request->students;
             $user->is_teacher = 1;
    
            $user->update();
  
    		$user->assignRole('teacher');

            if($request->hasFile('image')){

             $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move('storage/teacher', $imageName);;
                 
                 $teacher->image = $imageName;
            }

            $teacher->save();
  
        $details = [
            'n_title' => 'Welcome to Yocolab',
            'title' => 'Congratulations '.$user->name.' ! You are an Instructor now!',
            'message' => 'Thank you for using yocolab.com!',
            'actionURL' => url('teacher/profile/'),
        ];
  
        Notification::send($user, new SendNotification($details));
         \Mail::to($user->email)->send(new \App\Mail\BecomeTeacher );
            // return  redirect('/teacher/profile');
              return redirect('/teacher/profile')->with('success','Profile is Updated');

    		}

    		


    	}

      $user = Auth::user();

      if(!$user->hasRole('teacher')){

    	 return view('teacher.register');
      } else {
         return redirect('/');
      }

    }

    public function profile()
    { 


    	$user  = Auth::user();

    	$teacher = Teacher::with('user')->where('user_id',$user->id)->first();
        if(!$teacher){
            abort(404);
        }
      $courses =Course::where('date','>=', date('Y-m-d'))->where('status',1)->where('user_id',$user->id)->orderBy('date','asc')->take(10)->get();
      $students = StudentCourse::where('teacher_id',$user->id)->distinct('user_id')->count('user_id');
      $followers = FollowTeacher::where('teacher_id',$user->id)->count();
    	$teacher->self = 1 ;
 
    	return view('teacher.profile',compact('teacher','courses','students','followers'));


    }

     public function editProfile(Request $request)
    {
        $user  = Auth::user();
          $language = Language::whereStatus(1)->get();
        $country = Country::whereStatus(1)->get();

        $teacher = Teacher::with('user','course')->where('user_id',$user->id)->first();
          if(!$teacher){
            abort(404);
        }
        $teacher->self = 1 ;

        if($request->isMethod('post')){


                  $validated = $request->validate([
                   'image' => 'image',
                ],['image.image'=>'Profile image is invalid']);


            $data = Teacher::where('user_id',$user->id)->first();
            $data->expert = $request->expert;
            $data->qualification = $request->qualification;
            $data->experience = $request->experience;
            $data->country = $request->country;
            $data->category_id = $request->category_id;
            $data->language = $request->language;
              $data->currency = $request->currency;
           $data->price = $request->price1.'-'.$request->price2;
      // dd($request->all());
                // $data->about = nl2br($request->about);
            $textToStore = nl2br(htmlentities($request->about, ENT_QUOTES, 'UTF-8'));
            $data->about  = $textToStore;
            if($request->hasFile('image')){

             $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move('storage/teacher', $imageName);;
                 
                 $data->image = $imageName;
            }

            $data->update();
            $user = User::find(Auth::id());
            $user->name = $request->name;
            $user->update();
            return redirect('teacher/profile')->with('success','Profile is updated successfully');
        }
 
        return view('teacher.edit',compact('teacher','language','country'));

    }


     public function createCourse(Request $request)
    {
     
         $language = Language::whereStatus(1)->get();
        $user = Auth::user();
         $teacher = Teacher::with('user')->where('user_id',$user->id)->first();
           if(!$teacher){
            abort(404);
        }
         $teacher_card = SaveCards::where('user_id',Auth::user()->id)->first();
         $currencies = DB::table('currencies')->where('active', 1)->get();

    	   $category = Category::with('subcategory')->where(['parent_id'=>0,'status'=>1])->get();
        $material = Studymaterial::where('user_id',$user->id)->get();
    	 return view('teacher.create-course',compact('category','material','teacher','teacher_card','currencies','language'));
    }

       public function material(Request $request)
    {

         $validated = $request->validate([
                   'title' => 'required',
                   'file' => 'required',
                ],
                [  'title.required' => 'Title Is Mandatory',
                   'file.required' => 'Material file Is Mandatory',
                ]);


        $data = new Studymaterial;
         $user = Auth::user();
          $teacher = Teacher::with('user')->where('user_id',$user->id)->first();
           if(!$teacher){
            abort(404);
        }
        $data->user_id = $user->id;
        $data->title = $request->title;

         if($request->hasFile('file')){

             $imageName = time().'.'.request()->file->getClientOriginalExtension();

                request()->file->move(public_path('storage/material'), $imageName);

                 
                 $data->file = $imageName;
            }



        $data->save();

      if($request->ajax()){
           $file = Studymaterial::where('user_id',$user->id)->get();
            return response()->json($file);
               
            }

            else {


             return redirect()->back()->with('success','Study Material is added successfully'); 
            }
}

public function delete_material ($id)
{

  Studymaterial::destroy($id);
   return redirect()->back()->with('success','Study Material is deleted successfully'); 

}
public function updateMaterial(Request $request,$id)
{
    $validated = $request->validate([
                   'title' => 'required',
                   'file' => 'required',
                ],
                [  'title.required' => 'Title Is Mandatory',
                   'file.required' => 'Material file Is Mandatory',
                ]);

    $data = Studymaterial::find($id);

      $user = Auth::user();
          $teacher = Teacher::with('user')->where('user_id',$user->id)->first();
           if(!$teacher || !$data){
            abort(404);
        }
        $data->user_id = $user->id;
          if($request->hasFile('file')){

             $imageName = time().'.'.request()->file->getClientOriginalExtension();

                request()->file->move(public_path('storage/material'), $imageName);

                 
                 $data->file = $imageName;
            }



        $data->save();
         return redirect()->back()->with('success','Study Material is updated successfully'); 

}


    public function submitCourse(Request $request)
    {
    //  dd($request->all());
    	$new =1; 

            $user = Auth::user();
             $teacher = Teacher::with('user')->where('user_id',$user->id)->first();
           if(!$teacher){
            abort(404);
        }
     // dd($request->all());
        // $data = new Course ;
        $data = new Course ;
        $data->user_id = $user->id;
        $data->title = $request->title;
        $data->type = $request->type;
        if($request->sub_id > 0 ){
            $cat_id = $request->sub_id;
        }
        else {
            $cat_id = $request->cat_id; 
        }
        $data->category_id = $cat_id;


        if(session()->get('timezone')){

        $data->timezone = session()->get('timezone');
        }
        $data->level = $request->level;
        if(!$request->students){
          $data->students = 24;
        }else {

          $data->students = $request->students;
        }
        
         if($request->price){
          $data->price_type = 'paid';
        }

        $data->tags = $request->tags;
        // $data->desciption = $request->decription;
        
            $textToStore = nl2br(htmlentities($request->decription, ENT_QUOTES, 'UTF-8'));
            $data->desciption  = $textToStore;
        $data->language = $request->language;
        $data->currency = $request->currency;
        $data->price = $request->price;
        $data->discount = $request->discount;
        $data->url = $request->video_url;
        $data->learn = implode(';', $request->learn);
        $data->requirement = implode(';', $request->requirement);
          $a = explode('?v=', $request->video_url);
        if(count($a) >1){
        $b = explode('&', $a[1]);
        $data->url = 'https://www.youtube.com/embed/'.$b[0];
      }
      
   
       // $data->time =  $request->time;
        // $data->date = implode(';', $request->date);
        // $data->time = implode(';', $request->time);
        // $data->duration = implode(';', $request->duration);
      $n = [];
        if($request->material !=null ) {
        foreach ($request->material as $key => $value) {
          if(is_numeric($value)){

          array_push($n, $value);

          }else {
             $a = Studymaterial::where('title',$value)->first();
             array_push($n, $a->id);
          }
         

        }
      }


        $data->material_id = implode(';', $n);
        // $data->material_id = '2;3';


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

                   $slug=str_slug($request->title).'-'.generateRandomString();
                        $data->slug =$slug;


$l=0;

            if(is_array($request->date)) { 
            foreach ($request->date as $key => $value) {
              $l++;
               // echo $value.' '.$request->time[$key];
                $timzezone_time=DateTime::createFromFormat('d/m/Y H:i', $value.' '.$request->time[$key], new DateTimeZone(session('timezone')));
                // $datetime = new DateTime($format->format('Y-m-d'));
                $utc_date = clone $timzezone_time; // we don't want PHP's default pass object by reference here
                $utc_date->setTimeZone(new DateTimeZone('UTC'));
                   // $datetime->format('Y-m-d H:i:s');
             //   date_default_timezone_set(session('timezone'));

                if($request->price){
                  $duration =  $request->duration[$key];
                }
                  else {
                    $duration = 0.66;
                  }
              $date =  $utc_date->format('Y-m-d H:i:s');
              $zoom_date =   $utc_date->format('d M Y');
              $time =   $utc_date->format('H:i:s');
              // $time  = $request->time[$key];

            $slug=str_slug($request->title);

                $new =  $data->replicate()->fill([
                      'slug'=>$slug.'-'.generateRandomString(),
                      'date' => $date,
                      'time' => $time,
                      'duration' => $duration,
                  ]);

              // $new = $data->replicate();
              // $new->date = $value;
              // $new->time = $request->time[$key];
              // $new->duration = $request->duration[$key];
              // $new->push();
                  $new->save();
                $dt = Carbon::create($new->date);
                UpcompingCourse::dispatch($new)->delay($dt->subHours(5));
               // TeacherAttendClass::dispatch($new)->delay($dt->addMinutes(30));

                   $id = $new->id;
                   $slug = $new->slug;

  if($request->type=='Live'){

       if(!$request->price){
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
      $class->user_id = Auth::user()->id;
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


  }
 
      }  else {



              if($request->type=='Live'){

                          if(!$request->price) {
                                       $path = 'users/me/meetings';
                                        $response = $this->zoomPost($path, [
                                          'topic' => $request->title,
                                          'type' => 2,
                                          'start_time' => $request->date.'T'.$request->time,
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
                                    $class->user_id = Auth::user()->id;
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

              }  else {

                  $data->duration = $request->duration;
                   $data->save();
                      $dt = Carbon::create($data->date);
                 UpcompingCourse::dispatch($data)->delay($dt->subHours(5));
                 //   TeacherAttendClass::dispatch($data)->delay($dt->addMinutes(30));
                   $id = $data->id;
                   $slug = $data->slug;
              }


      }
              


          $timezone = timezone($data);
           $curr = currency_convert($data);
  
          $c_date = $timezone->date;
            $c_time = $timezone->time;
            $d =  teacherDetail(Auth::id());

         $details = [
        'subject' => 'New Course Arrived By '.$user->name.'! Yocolab',
        'heading'=>'New Class on Yocolab!',
        'description'=>'Your instructor '.ucfirst(Auth::user()->name).' has created a class. You can enroll for this class if it helps.',
        'id'=>$data->id,
        'instructor'=>Auth::user()->name,
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
                              'title'=>'New Course Arrived By '.$user->name,
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

     

        

            return redirect('class/'.$slug)->with('success','Class titled “ '.$data->title.' “  is created successfully');



    }

    public function bank(Request $request)
    {
      $url  = env('APP_URL');
      $api_secret = env('STRIPE_SECRET');
      $api_key = env('STRIPE_KEY');


       $teacher = Teacher::where('user_id',Auth::user()->id)->first();

           if(!$teacher){
            abort(404);
        }

       if($teacher->account_id){
        return redirect()->back();
       }

        else {

             \Stripe\Stripe::setApiKey ($api_secret);
                  $account = \Stripe\Account::create([
            'country' => $teacher->country,
            'type' => 'express',
            'email' => Auth::user()->email,
            'capabilities' => [
              'card_payments' => [
                'requested' => true,
              ],
              'transfers' => [
                'requested' => true,
              ],
            ],
          ]);
                     
      $acount_id = $account->id;
       session()->put('account', $acount_id);
   // $teacher->account_id  = $acount_id;

   //          $teacher->save();

      $account_links = \Stripe\AccountLink::create([
        'account' => $account->id,
        'refresh_url' => $url.'/refresh',
        'return_url' => $url.'/return',
        'type' => 'account_onboarding',
      ]);


      return redirect($account_links->url);
        }
     
    }


        public function updateBank()
        {
            $teacher =Teacher::where('user_id',Auth::id())->first();
            if(!$teacher){
                abort(404);
            }


        $api_secret = env('STRIPE_SECRET');
                     $api_key = env('STRIPE_KEY');
                    \Stripe\Stripe::setApiKey ($api_secret);
                    $stripe = new \Stripe\StripeClient($api_secret);
                    
             $account =$stripe->accounts->retrieve($teacher->account_id,);
            $account_links =     \Stripe\Account::createLoginLink($account->id);
        return redirect($account_links->url);

        }

    public function card(Request $request)
    {

      $api_secret = env('STRIPE_SECRET');
      $api_key = env('STRIPE_KEY');

       $teacher = Teacher::where('user_id',Auth::user()->id)->first();
        $teacher = Teacher::with('user')->where('user_id',$user->id)->first();
           if(!$teacher){
            abort(404);
        }
        \Stripe\Stripe::setApiKey ($api_secret);

        $stripe = new \Stripe\StripeClient($api_secret);






      if($request->isMethod('post')){

              try {
                dd($request->all());
                 // $customer = \Stripe\Customer::create(array("source" => $request->stripeToken, "description" => Auth::user()->name." Teacher is added"));
                 //        $card = new SaveCards;
                 //        $card->user_id = Auth::user()->id;
                 //        $card->customer_id = $customer->id;
                 //        $card->save();

                       return redirect()->back()->with('success','We have added your card. You can create the class now!');

//       // $customer = \Stripe\Customer::create(array("source" => $request->stripeToken, "description" => "Example customer"));
//       // $charge =  \Stripe\Charge::create(array("amount" => 10000, "currency" => "inr", "customer" => $customer->id));
// //                 $customer =$stripe->customers->createSource(
// //   'cus_JA30vLBd31Bu5U',
// //   ['source' =>$request->stripeToken]
// // );
// // $customer =$stripe->customers->retrieve(
// //   'cus_JA30vLBd31Bu5U',

// // );

//              $charge = \Stripe\Charge::create(array(
//     "amount" => 40000,
//     "currency" => "inr",
//     "customer" => "cus_JA48Ut1ebrxBhI", // ID of the customer you want to charge
//     "source" => "card_1IXk0xH8ZLByqdG3YY0ibDkd", // ID of the specific card, only needed if the customer has
//                             // multiple cards and you want to charge a different
//                             // card than the default one
// ));

// //             $card =  \Stripe\PaymentMethod::all([
// //   'customer' => 'cus_JA48Ut1ebrxBhI',
// // ]);
// dd($charge);

// //               $charge =  $stripe->charges->create([
// //   'amount' => 500000,
// //   'currency' => 'AFN',
// //   'source' => $request->stripeToken,
// //   'description' => 'My First INR Charge (created for API docs)',
// // ]);

//        dd($charge);

        } catch ( \Exception $e ) {
          dd($e);
        }
        
         if($teacher->account_id){

           $acount_id = $teacher->account_id;

           $stripe->accounts->createExternalAccount(
                  $acount_id,
                  ['external_account' => $request->stripeToken]
                );

           return redirect()->back();

         } else {

            try {

            $account = \Stripe\Account::create([
                    'country' => 'SG',
                    'type' => 'express',
                    'email' => Auth::user()->email,
                    'capabilities' => [
                      'card_payments' => [
                        'requested' => true,
                      ],
                      'transfers' => [
                        'requested' => true,
                      ],
                    ],
                  ]);


          $acount_id = $account->id;
           session()->put('account', $acount_id);
   // dd($request->stripeToken);
           // $stripe->accounts->createExternalAccount(
           //        'acct_1IU8PYQhIMw3u0WB',
           //        ['external_account' => $request->stripeToken]
           //      );
          

                  } catch ( \Exception $e ) {
       
   
               return redirect()->back()->with ( 'flash_error', $e );
            }
             return redirect()->back();

         }
      }
      return view('teacher.debit_card');
    }

    public function my_account()
    {
                 $api_secret = env('STRIPE_SECRET');
         $api_key = env('STRIPE_KEY');
    

         $stripe = new \Stripe\StripeClient($api_secret);

          $customer_cards = '';
          $bank_account = '';
           $saved_cards = SaveCards::where('user_id',Auth::user()->id)->first();
           $teacher = Teacher::where('user_id',Auth::user()->id)->first();
           $account_id = $teacher->account_id;

        
        \Stripe\Stripe::setApiKey ($api_secret);
        if($teacher->country !='IN'){

           if($account_id){
            $data =   $stripe->accounts->allExternalAccounts(
                    $account_id,
                    ['object' => 'bank_account', 'limit' => 1]
                  );
            $bank_account = $data->data[0];
           
           }
     } else {
        $res = Http::withBasicAuth(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'))->get('https://api.razorpay.com/v1/fund_accounts/'.$account_id);
        $bank_account = new StdClass;
                        $data= $res->json();
                            $bank_account->account_holder_name = $data['bank_account']['name'];
                            $bank_account->bank_name = $data['bank_account']['bank_name'];
                            $bank_account->no = $data['bank_account']['account_number'];
                            $bank_account->ifsc = $data['bank_account']['ifsc'];
                            $bank_account->account_holder_type = '';
                            $bank_account->country = 'India';
                     
                        

     }

           if($saved_cards){

           $customer =$stripe->customers->retrieve($saved_cards->customer_id);
            $customer_cards = $customer->sources;

         }
         return view('teacher.my_account',compact('customer_cards','bank_account'));
    }




     public function bank_details()
    {
      return view('teacher.bank');
    }

    public function returnBank()
    {   

          $teacher = Teacher::where('user_id',Auth::user()->id)->first();
        $account_id = session('account');
        // session()->forget('account');
        $teacher->account_id  = $account_id;
            $teacher->save();

        
        return redirect('/teacher/create-course')->with('success','Bank Account added successfully');
    }

      public function refreshBank()
    {  
       return redirect('/teacher/create-course')->with('error','Bank Account not Added Retry ??');
    }

    public function editCourse($slug)
    {
        $user = Auth::user();
          $language = Language::whereStatus(1)->get();

        $course = Course::where('slug',$slug)->where('user_id',Auth::id())->first();
        if(!$course){
            abort(404);
        }
      $category = Category::where(['parent_id'=>0,'status'=>1])->get();
      $course->category = Category::with('parentCategory')->find($course->category_id);
       $subcategory = '';
      if($course->category->parentCategory){

        $course->category_id = $course->category->parent_id;
      $subcategory = Category::where(['parent_id'=>$course->category->parent_id,'status'=>1])->get();

      }
        $timezone = timezone($course);
        $course->date = $timezone->date;
        $course->time = $timezone->time;

         $currencies = DB::table('currencies')->where('active', 1)->get();
        $material = Studymaterial::where('user_id',$user->id)->get();
       return view('teacher.edit-course',compact('category','material','course','currencies','subcategory','language'));
    }


    public function editSubmitCourse (Request $request,$id)
    {
      $data =  Course::where('id',$id)->where('user_id',Auth::id())->first() ;
     
        $data->title = $request->title;
       
        if($request->sub_id > 0 ){
            $cat_id = $request->sub_id;
        }
        else {
            $cat_id = $request->cat_id; 
        }
        $data->category_id = $cat_id;
        $data->level = $request->level;
        
        $data->tags = $request->tags;
        $textToStore = nl2br(htmlentities($request->decription, ENT_QUOTES, 'UTF-8'));
            $data->desciption  = $textToStore;

        $data->students = $request->students;
        $data->language = $request->language;
              $slug=str_slug($request->title).'-'.generateRandomString();
                        $data->slug =$slug;
 
        $a = explode('?v=', $request->video_url);
        if(count($a) >1){
        $b = explode('&', $a[1]);
        $data->url = 'https://www.youtube.com/embed/'.$b[0];
      }
        $data->learn = implode(';', $request->learn);
    
        $data->requirement = implode(';', $request->requirement);

           $n = [];
      if($request->material !=null ) {
        foreach ($request->material as $key => $value) {
          if(is_numeric($value)){

          array_push($n, $value);

          }else {
             $a = Studymaterial::where('title',$value)->first();
             array_push($n, $a->id);
          }
         

        }
      }




        $data->material_id = implode(';', $n);

          if($request->hasFile('image')){

             $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move(public_path('storage/course'), $imageName);;
                 
                 $data->image = $imageName;
            }


         if($request->hasFile('preview_video')){

             $imageName = time().'.'.request()->preview_video->getClientOriginalExtension();

                request()->preview_video->move(public_path('storage/video'), $imageName);

                 
                 $data->video = $imageName;
            }

              if($request->hasFile('video')){

             $imageName = time().'.'.request()->video->getClientOriginalExtension();

                request()->preview_video->move(public_path('storage/video'), $imageName);

                 
                 $data->preview = $imageName;
            }


            $data->save();

            return redirect('class/'.$data->slug)->with('success','“ '.$data->title.' “  is updated successfully');
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




public function dashboard()
{


	
    $teacher = Teacher::where('user_id',Auth::user()->id)->first();
  $students = StudentCourse::where('teacher_id',$teacher->user_id)->count();
  $courses = Course::where('user_id',$teacher->user_id)->orderBy('date','asc')->count();
  $material = StudyMaterial::where('user_id',$teacher->user_id)->count();
  $recent_courses = Course::with('user','student','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('user_id',$teacher->user_id)->where('type','Live')->where('status',1)->where('date','>=',date('Y-m-d'))->orderBy('date', 'asc')->take(5)->get();



  return view('teacher.dashboard',compact('students','courses','material','recent_courses'));
}

public function my_courses()
{
	 $teacher = Teacher::where('user_id',Auth::user()->id)->first();
  $courses = Course::with('user','student','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('user_id',$teacher->user_id)->where('date','>=',date('Y-m-d'))->where('type','Live')->where('status',1)->orderBy('date', 'asc')->paginate(7);


  return view('teacher.my-courses',compact('courses'));
  
}

public function courses()
{
	 $teacher = Teacher::where('user_id',Auth::user()->id)->first();
   $courses = Course::with('user','student')->where('user_id',$teacher->user_id)->orderBy('created_at', 'desc')->paginate(7);
  return view('teacher.all-courses',compact('courses'));
}  


public function study_material(Request $request)
{
     $teacher = Teacher::where('user_id',Auth::user()->id)->first();
   $datas = StudyMaterial::with('teacher')->where('user_id',$teacher->user_id)->get();
      return view('teacher.material',compact('datas'));
}

public function my_earning()
{

     $teacher = Teacher::where('user_id',Auth::user()->id)->first();
  // $courses = Course::with('user','student')->where('user_id',Auth::user()->id)->where('price_type','paid')->orderBy('date', 'desc')->paginate(7);
    $courses = Earning::where('user_id',$teacher->user_id)->orderBy('id','desc')->get();
      return view('teacher.my_earning',compact('courses'));
}

public function request_class()
{
     $teacher = Teacher::where('user_id',Auth::user()->id)->first();

  $request_class = RequestClass::where('teacher_id',$teacher->user_id)->orderBy('created_at', 'desc')->paginate(7);
      return view('teacher.requested_class',compact('request_class'));
}

public function my_feedback()
{

     $teacher = Teacher::where('user_id',Auth::user()->id)->first();
  $feedbacks = Feedback::with('user','course')->where('teacher_id',$teacher->user_id)->orderBy('created_at', 'desc')->paginate(7);
      return view('teacher.feedback',compact('feedbacks'));
}


  public function followers()
    {

         $teacher = Teacher::where('user_id',Auth::user()->id)->first();

       $followers = FollowTeacher::with('user')->where('teacher_id',$teacher->user_id)->orderBy('created_at','DESC')->paginate(7);

        return view('teacher.follower',compact('followers'));
    }

public function cancelCourse(Request $request)
{
                 // Course::find($id);
                  $api_secret = env('STRIPE_SECRET');
                     $api_key = env('STRIPE_KEY');
                    \Stripe\Stripe::setApiKey ($api_secret);
                    $stripe = new \Stripe\StripeClient($api_secret);
       $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                      $total_price = 0;
                      $amount = 0;
                      $teacher_amount = 0;


                      $id = $request->id;
                      $StudentCourse = StudentCourse::with('course')->where('course_id',$id)->where('status','done')->get();
                      $course = Course::with('user')->find($request->id);
                   
                      $timezone = timezone($course);
                      $curr = currency_convert($course);
                      
                      $c_date = $timezone->date;
                        $c_time = $timezone->time;
                      $teacher_det = teacherDetail($course->user_id);
                      $currency="";
                      // $account =$stripe->accounts->retrieve($teacher_det->account_id,);

                 if($course->type =='Live' && $course->price_type =='paid'){

                      $amount =$course->price;
                      if($course->discount){

                          $amount = $course->price - ($course->price*$course->discount)/100;
                      }

                      $fee = round((6*$amount)/100,2) ;
               
                        // $fee_amount =$amount+$fee;
                        $fee_amount =$amount;

                   $charges  = Charge::where('course_id',$id)->where('status',1)->get();
                
                     $start_date = new DateTime($course->date);
                      $since_start = $start_date->diff(new DateTime('NOW'));
                     
                if($since_start->invert > 0){

                                      $i = 0;

                                    foreach ($charges as $charge) {
                                          
                                            $i++;
                                          // $fee_amount = $fee_amount + $fee_amount;
                                             if($teacher_det->country !='IN'){
                                                 $account =$stripe->accounts->retrieve($teacher_det->account_id,);
                                            $currency= $account->default_currency;
                                              $ch = $stripe->refunds->create([  'charge' => $charge->charge_id,'amount'=>$charge->amount ]);
                                            } else {
                                                // dd($charge->id);
                                                 $currency ='INR';
                                                 $payment = $api->payment->fetch($charge->charge_id);
                                                $refund = $payment->refund(array('amount' => $charge->amount));
                                            }

                                         // $ch = $stripe->refunds->create([  'charge' => $charge->charge_id,'amount'=>$charge->amount ]);
                                         $charge->refund =  1;
                                         $charge->status =  0;
                                         $charge->update();

                                             $d =  teacherDetail(Auth::id());

   
                                              $user = User::find($charge->user_id);
                                        

                                                    $subtotal = $curr->price;
                                 // $cent = currency(0.50, 'SGD',  $curr->currency->code,$format = false);
                                  $fee =  ($subtotal*6)/100  ;  
                                         
                                            $symbol = $curr->currency->symbol;
                                       
                                        $fee = round($fee,2);
                                          $mail['details'] = ['subject' => 'Oops! '.$course->title.' has been cancelled . 
                                                                                ',
                                                    'heading'=>'Oops, Your Instructor cancelled the class',
                                                      'description'=>'We have initiated a full refund of '.$symbol.' '.($charge->amount/100).' and the same will be
                                                                        credited to your account within 7-10 working days',
                                                       'instructor'=>Auth::user()->name,
                                                            'title'=>$course->title,
                                                            'image'=>$course->image,
                                                            'date'=>$c_date,
                                                            'time'=>$c_time,
                                                            'desc'=>$course->desciption,
                                                            'btn'=>'Join Class',
                                                              'rating'=>intval($d->rating),
                                                            'price'=>$curr->html,
                                                            'fee'=>$fee,
                                                            'symbol'=>$symbol,
                                                            'charge'=>($charge->amount/100),
                                                            'url'=>url('class/'.$course->slug),
                                                     ];

                                                         $details = [
                                            'n_title' => 'Hi Yocolab',
                                            'title' => '<font color="red">Alert </font>',
                                            'message' => ' “ '.ucfirst(Auth::user()->name).'“  has cancelled   “'.$course->title.'“',
                                            'actionURL' => url('class/'.$course->slug),
                                        ];

                                             Notification::send($user, new SendNotification($details));
                                              Mail::send('mail.course', $mail, function($message) use ($user) {
                                                         $message->to($user->email)->subject('Oops! Instructor has cancelled the class .');
                                                         
                                                      });

                                         
                                    } 


                         if($since_start->days == 0)
                         {
                             
                             $total_price  = $fee_amount*$i;
                             $teacher_amount =round((15*$total_price)/100,2);

                            $teacher_amount =  round(currency($teacher_amount, $course->currency, $currency,false),2);
                             $teacher = SaveCards::where('user_id',$course->user_id)->first();
                            if($teacher_amount > 0) {
                                       $charge = \Stripe\Charge::create([
                                        'amount' => $teacher_amount*100, // $15.00 this time
                                        'currency' => $currency,
                                        'customer' => $teacher->customer_id, // Previously stored, then retrieved
                                    ]);
                                   }
                                                
                        } 
                          else {


                                     // $total_price = 0;
                                   $total_price  = $fee_amount*$i;
                                    $teacher_amount =round((10*$total_price)/100,2);
                                    $teacher_amount =  round(currency($teacher_amount, $course->currency, $currency,false),2);
                                   $teacher = SaveCards::where('user_id',$course->user_id)->first();

                                   
                                    // \Stripe\Transfer::create([
                                    //   "amount" =>$teacher_amount,
                                    //   "currency" => "sgd",
                                    //   "destination" => $teacher->account_id,
                                    //   "transfer_group" => "Teacher Cancel course refund"
                         if($teacher_amount > 0) {
                                   $charge = \Stripe\Charge::create([
                                        'amount' => $teacher_amount*100, // $15.00 this time
                                        'currency' => $currency,
                                        'customer' => $teacher->customer_id, // Previously stored, then retrieved
                                    ]); 
                             }
                        }

                                     $user = User::find(Auth::id());
                                         $details = [
                                            'subject' => ' Class Cancellation Summary for  '.$course->title.' | Yocolab ',
                                            'heading'=>'Below is your cancellation summary. ',
                                            'id'=>$course->id,
                                            'title'=>$course->title,
                                            'image'=>$course->image,
                                            'date'=>$c_date,
                                            'time'=>$c_time,
                                            'qty'=>count($StudentCourse),
                                            'cfee'=>$teacher_amount,
                                            'total'=>$total_price,
                                            'price'=>$amount,

                                            
                                        ];
                                        \Mail::to($user->email)->send(new \App\Mail\TeacherCancelMail($details));
                        
                }


                $earning = new Earning;

                $earning->user_id = Auth::id();
                $earning->course_id = $course->id;
                $earning->title = $course->title;
                $earning->date = $course->date;
                $earning->price = $amount;
                $earning->currency = $course->currency;
                $earning->students = count($charges);
                $earning->status = 'cancelled';
                $earning->total = $teacher_amount;
                $earning->save();


   }
if($curr->html == 'Free'){
  $curr->html = '';
}


$user = User::find(Auth::id());
   $detail1 = [
            'n_title' => 'Hi Yocolab',
            'title' => '<font color="red">Alert </font>',
            'message' => 'You have cancelled '.$course->title,
            'actionURL' => url('class/'.$course->slug),
        ];
 Notification::send($user, new SendNotification($detail1));

 $course->status = 0 ;
 $course->update();

    
    // StudentCourse::find($data->id); 
      return redirect()->back()->with('success','You have successfully cancelled class named "'.$course->title.'" .<br> Cancellation Fee : <b>"'.strtoupper($currency).' '.$teacher_amount.'"</b>.
');

}


public function meeting_end($id)
{

      $api_secret = env('STRIPE_SECRET');
                     $api_key = env('STRIPE_KEY');
                    \Stripe\Stripe::setApiKey ($api_secret);
                   $stripe = new \Stripe\StripeClient($api_secret);

    $course = Course::where('slug',$id)->where('user_id',Auth::id())->first();
  $video_class = VideoClass::where('course_id',$course->id)->where('user_id',Auth::id())->first();
  if(!$video_class){
    abort(404);
  }
  $video_class->token = '';
  $video_class->status = 'end';
  $video_class->update();

    $detail = [
        'subject' => 'Course Ended Feedback form',
        'id'=>$course->id,
        'class_id'=>$id,
        'title'=>$course->title,
        'image'=>$course->image,
        'date'=>date('d M Y'),
        'teacher'=>$course->user->name,
        'description'=>'Please give your valuable input regarding this course to teacher',
  
    ];
   


 $StudentCourse = StudentCourse::with('course')->where('course_id',$course->id)->where('status','done')->get();

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
 
        $data['message'] = 'Session ended by teacher';
        $pusher->trigger('end_meeting', 'App\\Events\\Notify', $data);


$teacher_amount = 0;
$amount = $course->price;
      
if($course->discount){
        $amount = $amount - ($course->discount*$amount)/100;
       }

   $timezone = timezone($course);
  
  $c_date = $timezone->date;
   $c_time = $timezone->time;
    $d =  teacherDetail($course->user_id);
    $curr = currency_convert($course);
    $symbol = $d->symbol;
    if($curr->html =='Free'){
      $curr->html ='';
    }

        $details = [
            'n_title' => 'Thanks for completed this Class',
            'title' => 'Feedback for “ '.Auth::user()->name.' “',
            'message' => 'Please give your feedback to teacher for this class “ '.$course->title.' “',
            'actionURL' => url('class/'.$course->slug),
           
        ];
   
foreach ($StudentCourse as $item) {
  $user = User::find($item->user_id);

  $feedback = Feedback::where('user_id',$user->id)->where('course_id',$course->id)->first();
  if(!$feedback){

 Notification::send($user, new SendNotification($details));

           $curr = currency_convert($course);
  
 

         $mail = [
        'subject' => 'Your valuable feedback is important to us! Yocolab',
        'heading'=>'Well Done '.ucfirst($user->name).'!',
       'description'=>'You have successfully completed class hosted by “'.ucfirst(Auth::user()->name).' “',
       'instructor'=>$d->user->name,
       'title'=>$course->title,
 
                                                            'image'=>$course->image,
                                                            'date'=>$c_date,
                                                            'time'=>$c_time,
                                                            'desc'=>$course->desciption,
                                              
                                                              'rating'=>intval($d->rating),
                                                            'price'=>$curr->html,
                                                          

                                                      
        'btn'=>'Leave Feedback',
        'url'=>url('/user/feedback/'.$course->slug),
        'fee'=>$curr->html,
        
    ];
    //        $mail = [
    //     'subject' => 'Your valuable feedback is important to us ',
    //     'heading'=>'Well Done '.ucfirst($user->name).'!',
    //     'description'=>'You have successfully completed class hosted by “'.ucfirst(Auth::user()->name).' “',
    //     'id'=>$course->id,
    //     'title'=>$course->title,
    //     'image'=>$course->image,
    //     'date'=>$c_date,
    //     'time'=>$c_time,
    //     'btn'=>'Leave Feedback',
    //     'url'=>url('/user/feedback/'.$course->slug),
    //     'fee'=>$curr->html,
        
    // ];
    // \Mail::to($user->email)->send(new \App\Mail\StudentCancel($details));
 \Mail::to($user->email)->send(new \App\Mail\FeedbackMail($mail));

  }
    


$teacher_amount = $teacher_amount + $amount; 

               
 }



 // $b = $stripe->balance->retrieve();
 // dd($b);


  // // dd($teacher_amount);

        if($course->price_type =='paid'){

             $type =0;
            $status = 'pending';

       $t_total = round(($teacher_amount)/100,2);
       $tfee = round((25*$teacher_amount)/100,2);
       $teacher_amount = round((75*$teacher_amount)/100,2);
       // dd(round($teacher_amount*100));
// dd($teacher_amount);

  $teacher = Teacher::where('user_id',$course->user_id)->first();

  if($teacher->country != 'IN'){ 

   
  $teacher_amount =  round(currency($teacher_amount, $course->currency, 'SGD',false),2);

        if($teacher_amount >0){
                          $account =$stripe->accounts->retrieve($teacher->account_id,);
                            $currency = $account->default_currency;
                       // $charge =   \Stripe\Transfer::create([
                       //        "amount" =>$teacher_amount*100,
                       //        "currency" => $account->default_currency,
                       //        "destination" => $teacher->account_id,
                       //        "transfer_group" => "Course completed payment"
                       //      ]);

                       $ch = new Charge;
                           // $ch->charge_id = $charge->id;
                            $ch->course_id = $course->id;
                           $ch->amount = $teacher_amount*100;
                           $ch->customer_id = $teacher->account_id;
                           $ch->teacher_id = Auth::user()->id;
                           $ch->currency = $account->default_currency;
                           $ch->save();
                         TeacherPayment::dispatch($ch)->delay(now()->addDays(7));

                       }


  } else{
          $teacher_amount =  round(currency($teacher_amount, $course->currency, 'INR',false),2);
               $type =1;
          $status = 'pending';
             $currency = 'INR';
  }
                          // dd($teacher);

                             // TeacherPayment::dispatch($ch)->delay(now()->addDays(7));

$user = User::find($course->user->id);
       $details = [
        'subject' => ' Earnings  For '.$course->title.' | Yocolab ',
        'heading'=>' Awesome! Your class '.$course->title.' is successfully completed. Find your earnings below. ',
        'description'=>'You have successfully completed class hosted by '.ucfirst(Auth::user()->name),
        'id'=>$course->id,
        'title'=>$course->title,
        'image'=>$course->image,
        'date'=>$c_date,
        'time'=>$c_time,
        'qty'=>count($StudentCourse),
        'amount'=>$t_total,
        'cfee'=>$tfee,
        'total'=>$teacher_amount,
        'price'=>$amount,
        'symbol'=>$symbol,


        
    ];
    \Mail::to($user->email)->send(new \App\Mail\Earning($details));

                           $earning = Earning::where('course_id',$course->id)->first();
                         if(!$earning){

                              $earning = new Earning;
                                $earning->user_id = Auth::id();
                                $earning->type = $type;
                                $earning->course_id = $course->id;
                                $earning->title = $course->title;
                                $earning->date = $course->date;
                                $earning->price = $amount;
                                $earning->currency = $course->currency;
                                $earning->students = count($StudentCourse);
                                $earning->status = $status;
                                $earning->total = $teacher_amount;
                                $earning->save();
                         }



  return redirect('/class/'.$course->slug)->with('success','Great! Your earning for the class titled “ '.$course->title.' “ is <b> '.strtoupper($course->currency).' </b> '.$teacher_amount.' This will be credited  to your bank account in 7-8 business days.');
} else {
    return redirect('/class/'.$course->slug)->with('success','Congratulations! Your class titled “ '.$course->title.'“ is successfully completed.');
}

}

public function leave_class($id)
{
  $video_class = VideoClass::find($id);
  $course = Course::with('user')->find($video_class->course_id);
    return redirect('/class/'.$course->slug);
}

public function stop_archive(Request $request)
{
  
}


public function start_archive(Request $request)
{
  dd($request->all());
}

    public function resheduleCourse($slug)
    {
        $user = Auth::user();
        $course = Course::where('slug',$slug,)->where('user_id',$user->id)->first();
          $teacher = Teacher::with('user')->where('user_id',$user->id)->first();
      
        
        if(!$course){
            abort(404);
        }
      $category = Category::where(['parent_id'=>0,'status'=>1])->get();
      $course->category = Category::with('parentCategory')->find($course->category_id);
       $subcategory = '';
      if($course->category->parentCategory){

        $course->category_id = $course->category->parent_id;
      $subcategory = Category::where(['parent_id'=>$course->category->parent_id,'status'=>1])->get();

      }
         $teacher_card = SaveCards::where('user_id',Auth::user()->id)->first();

         $currencies = DB::table('currencies')->where('active', 1)->get();
        $material = Studymaterial::where('user_id',$user->id)->get();
       return view('teacher.reschedule',compact('category','material','course','currencies','subcategory','teacher','teacher_card'));
    }

 public function resheduleSubmitCourse(Request $request)
    {
        // dd($request->all());
        $course = Course::where('slug',$request->slug)->where('user_id',Auth::id())->first();

        if(!$course){
            abort(403);
        }
        $user = User::find($course->user_id);
        $data = new Course;
        $data->user_id = $course->user_id;
        $data->title = $request->title;
            $data->type = $request->type;
       
         if($request->sub_id > 0 ){
            $cat_id = $request->sub_id;
        }
        else {
            $cat_id = $request->cat_id; 
        }
        $data->category_id = $cat_id;
        if($request->price){
                      $data->price_type = 'paid';
         }
        $data->level = $request->level;
        
    
        $data->tags = $request->tags;
        $data->currency = $request->currency;
        $data->price = $request->price;
        $data->discount = $request->discount;
        // $data->desciption = $request->decription;
         $textToStore = nl2br(htmlentities($request->decription, ENT_QUOTES, 'UTF-8'));
            $data->desciption  = $textToStore;

        $data->students = $request->students;
        $data->language = $request->language;
            $slug=str_slug($request->title).'-'.generateRandomString();
         $data->slug =$slug;

         $timzezone_time=DateTime::createFromFormat('d/m/Y H:i', $request->date.' '.$request->time, new DateTimeZone(session('timezone')));
         $utc_date = clone $timzezone_time; // we don't want PHP's default pass object by reference here
          $utc_date->setTimeZone(new DateTimeZone('UTC'));
                 if($request->price){
                                      $duration =  $request->duration;
                                    }
                                    else {
                                        $duration = 0.66;
                   }




                          $date =  $utc_date->format('Y-m-d H:i:s');
                          $zoom_date =   $utc_date->format('d M Y');
                          $time =   $utc_date->format('H:i:s');
        $data->date = $date;
        $data->time = $time;
        $data->duration = $duration;

 
        $a = explode('?v=', $request->video_url);
        if(count($a) >1){
        $b = explode('&', $a[1]);
        $data->url = 'https://www.youtube.com/embed/'.$b[0];
      }
        $data->learn = implode(';', $request->learn);
    
        $data->requirement = implode(';', $request->requirement);

           $n = [];
              if($request->material !=null ) {
                foreach ($request->material as $key => $value) {
                  if(is_numeric($value)){

                  array_push($n, $value);

                  }else {
                     $a = Studymaterial::where('title',$value)->first();
                     array_push($n, $a->id);
                  }
                 

                }
              }




        $data->material_id = implode(';', $n);
           if($request->hasFile('image')){

             $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move(public_path('storage/course'), $imageName);;
                 
                 $data->image = $imageName;
            } else {

                 $data->image = $course->image;
            }


         if($request->hasFile('preview_video')){

             $imageName = time().'.'.request()->preview_video->getClientOriginalExtension();

                request()->preview_video->move(public_path('storage/video'), $imageName);

                 
                 $data->video = $imageName;
            } else {

                 $data->video = $course->video;
            }

              if($request->hasFile('video')){

             $imageName = time().'.'.request()->video->getClientOriginalExtension();

                request()->preview_video->move(public_path('storage/video'), $imageName);

                 
                 $data->preview = $imageName;
            }
            else {

                 $data->preview = $course->preview;
            }
// dd($data);
            $data->save();

                         if($request->paid == 'paid' && ($request->price))
                                         {
                                                   $apiObj = new OpenTok(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
                                                           $session = $apiObj->createSession( array(
                                                            'archiveMode' => ArchiveMode::ALWAYS,
                                                            'mediaMode' => MediaMode::ROUTED
                                                        ));

                                              
                                                  $class = new VideoClass();
                                                  // Generate a name based on the name the teacher entered
                                                  $class->name = $request->title . " class";
                                                  $class->course_id = $data->id;
                                                 $class->user_id = $course->user_id;

                                                  // Store the unique ID of the session
                                                  $class->session_id = $session->getSessionId();
                                                  // Save this class as a relationship to the teacher
                                                   $user->myClass()->save($class);
                                                  $class->save();

                                                } else 
                                                {


                        
                                                  

                                                   $path = 'users/me/meetings';
                                                    $response = $this->zoomPost($path, [
                                                      'topic' => $request->title,
                                                      'type' => 2,
                                                      'start_time' => $request->date.'T'.$request->time,
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
                                                $class->course_id = $data->id;
                                                $class->name = $request->title;
                                                $class->user_id = $course->user_id;
                                                $class->zoom_app_id = $this->zoom_id;
                                                $class->zoom_url = $data1['join_url'];
                                                $class->zoom_id = $data1['id'];
                                                $class->zoom_time = $data1['start_time'];
                                                $class->zoom_password = $data1['encrypted_password'];
                                                $class->save();
                                                }

             // Send Mail to all user who  follow this teacher 

                            $timezone = timezone($data);
                            $curr = currency_convert($data);
  
                            $c_date = $timezone->date;
                            $c_time = $timezone->time;
                            $d =  teacherDetail(Auth::id());

                             $details = [
                            'subject' => 'New Course Arrived By '.$user->name.'! Yocolab',
                            'heading'=>'New Class on Yocolab!',
                            'description'=>'Your instructor '.ucfirst(Auth::user()->name).' has created a class. You can enroll for this class if it helps.',
                            'id'=>$data->id,
                            'instructor'=>Auth::user()->name,
                            'title'=>$data->title,
                            'image'=>$data->image,
                            'date'=>$c_date,
                            'time'=>$c_time,
                            'rating'=>intval($d->rating),
                            'price'=>$curr->html,
                            'btn'=>'Enroll Now',
                            'url'=>url('class/'.$data->slug),
                            
                        ];
                       
                            $detail = [
                              'n_title' => 'Welcome to Yocolab',
                              'title'=>'New Course Arrived By '.$user->name,
                              'title'=>'“'.$user->name. '“ has created a new class.',
                              'message' => ucfirst(Auth::user()->name).' has created new class '.$data->title,
                              'actionURL' => url('course/'.$data->slug),
                          ];
                    
                          $users = FollowTeacher::where('teacher_id',$user->id)->get();
                          foreach ($users as $item) {
                          
                               $student = User::find($item->user_id);
                               if($student){

                                  Notification::send($student, new SendNotification($detail));
                                  \Mail::to($student->email)->send(new \App\Mail\FollowCourseMail($details));
                               }


                                }
                                     

    return redirect('class/'.$slug)->with('success','Class titled “ '.$data->title.' “  is reshedule successfully');


    }

    public function add_bank(Request $request)
{
$client = new \GuzzleHttp\Client();

$razoer_key = env('RAZORPAY_KEY'); 
$razor_secret = env('RAZORPAY_SECRET');

    if($request->isMethod('post')){ 

        $user = Auth::user();
                try { 

                    $res = Http::withBasicAuth($razoer_key,$razor_secret)->post('https://api.razorpay.com/v1/contacts', [
                        'name' => $user->name,
                        'email' => $user->email,
                        'contact' => $user->phone,
                        'type' => 'vendor',
                    ]);

                    $contact = $res->json();

                    $bank = ['name'=>$request->name,'ifsc'=>$request->ifsc,'account_number'=>$request->account];


                        $res = Http::withBasicAuth($razoer_key,$razor_secret)->post('https://api.razorpay.com/v1/fund_accounts', [
                            'contact_id' => $contact['id'],
                            'account_type' => 'bank_account',
                            'bank_account' => $bank
                        ]);

                    $fund = $res->json();
                      // dd($fund);
                    if($res->status() == '200' ){
                
                        if($fund['id']){

                            $teacher = Teacher::where('user_id',$user->id)->first();
                            $teacher->account_id = $fund['id'];
                            $teacher->update();
                            return redirect('/teacher/create-course')->with('success','Bank Account added successfully');
                        }

                    } else {

                      return redirect()->back()->with ( 'error', 'Pleae Try again' );
                    }


              }
                 catch ( \Exception $e ) {

   
               return redirect()->back()->with ( 'error', 'There is a problem in from bank reponse' );
            }

    }


//  $res = Http::withBasicAuth(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'))->get('https://api.razorpay.com/v1/fund_accounts/fa_HW0htuDBeygPtT');

// $result = $res->json();
// $conact = [  'name' => 'Taylor',
//     'email' => 'yogesh@ebslon.com',
//     'contact' => '9876543234',
//     'type' => 'vendor'];
// $fund = ['account_type'=>'bank_account','bank_account'=>$bank,'contact'=>$conact];
// $res = Http::withBasicAuth(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'))->post('https://api.razorpay.com/v1/payouts', [
//     'account_number' => '2323230055690972',
//     'amount' => '1000',
//     'currency'=>'INR',
//     'mode'=>'NEFT',
//     'purpose'=>'vendor bill',
//     '

  
// ]);
// dd($res->json());

// $res = Http::withBasicAuth(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'))->post('https://api.razorpay.com/v1/payout-links', [
//     'account_number' => '2323230055690972',
//     'amount' => '1000',
//     'currency'=>'INR',
//     'purpose'=>'vendor bill',
//     'contact' => $conact,

  
// ]);
// dd($res->json());
  return view('teacher.bank');
}


}

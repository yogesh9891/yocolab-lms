<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
use App\Models\Language;
use App\Models\Country;

use App\Notifications\StudentNotification;
use App\Notifications\SendNotification;

use Razorpay\Api\Api;
use Auth,Mail;
use Notification;
use DateTime;


class StudentController extends Controller
{
    //

     public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function dashboard()

    {   

      // if($id){
      // $notification = auth()->user()->notifications()->where('id', $id)->first();

      //   if ($notification) {
      //       $notification->markAsRead();
            
      //   }
      // }

      
      
          $students = StudentCourse::where('user_id',Auth::user()->id)->where('status','done')->count();
            $teacher = FollowTeacher::where('user_id',Auth::user()->id)->count();
            $bookmark = Cart::where('user_id',Auth::user()->id)->count();
             $recent_courses = StudentCourse::with('teacher_details','teacher','course','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->whereHas('course', function($query) {
                  $query->where('date', '>=', date('Y-m-d'));
             })->where(['user_id'=>Auth::user()->id,'type'=>'Live','status'=>'done'])->take(5)->get();
          
    	return view('student.dashboard',compact('students','teacher','bookmark','recent_courses'));
    }


    public function mycourse()
    {

    	$stu_courses = StudentCourse::with('teacher_details','teacher','course','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->whereHas('course', function($query) {
                  $query->where('date', '>=', date('Y-m-d'));
             })->where('user_id',Auth::user()->id)->where('status','done')->paginate(7);
    	$user = User::find(Auth::user()->id);
    	return view('student.my_course',compact('stu_courses','user'));
    
    }

     public function orders()
    {

    	$stu_courses = StudentCourse::with('teacher_details','teacher','course')->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(7);
    	$user = User::find(Auth::user()->id);
    	return view('student.orders',compact('stu_courses','user'));
    }

  

      public function wishlist()
    {
    		$stu_courses = Cart::with('course')->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
   
    	$user = User::find(Auth::user()->id);
    	return view('student.bookmark',compact('stu_courses'));
    }

    public function teachers()
    {
    	$teachers = FollowTeacher::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
       
    	return view('student.teachers',compact('teachers'));
    }

    public function course($id)
    {
    	  $course = Course::with('teacher','user','video_class','category')->find($id);
            $stu_enrolled = StudentCourse::where('course_id',$course->id)->count();
             $stu_course = '';

          $stu_course = StudentCourse::where('user_id',Auth::user()->id)->where('course_id',$course->id)->first();

         if($stu_course){
             return view('student.course',compact('course','stu_course','stu_enrolled'));


         }else{

             return view('course-details',compact('course','stu_course','stu_enrolled'));
         }
      
    }


    public function follow(Request $request)
    {
        $teacher = Teacher::where('teacher_id',$request->t_id)->first();
        $t = teacherDetail($teacher->user_id);
        // dd($teacher);
     if($teacher){
    	if($request->type=='follow'){
    		$d= FollowTeacher::where('user_id',Auth::user()->id)->where('teacher_id',$teacher->user_id)->first();
          

    		if(!$d){

                		$data = new FollowTeacher;
                		$data->teacher_id = $teacher->user_id;
                		$data->user_id = Auth::user()->id;
                		$data->save();
                        return redirect()->back()->with('success','Thanks for following '.$t->user->name);

                }
                        return redirect()->back()->with('success','You already following '.$t->user->name);



    		}
    	 else {
    		$data= FollowTeacher::where('user_id',Auth::user()->id)->where('teacher_id',$teacher->user_id)->first();
    		if($data){
    			FollowTeacher::destroy($data->id);
                 return redirect()->back()->with('success','You unfollow following '.$t->user->name);
    		}
    		
    	}
    }
    		return redirect()->back();
    }


    public function notice()
    {
        $user = Auth::user();
  
        $details = [
            'n_title' => 'Hi Yocolab',
            'title' => 'This is my second notification ',
            'message' => 'Thank you for using yocolab.com!',
            'actionURL' => url('user/dashboard'),
        ];
  
        Notification::send($user, new StudentNotification($details));

       dd($user->notifications);
    }


    public function cancelCourse(Request $request)
    {
                   $api_secret = env('STRIPE_SECRET');
                     $api_key = env('STRIPE_KEY');
                    \Stripe\Stripe::setApiKey ($api_secret);
                   $stripe = new \Stripe\StripeClient($api_secret);



        $id = $request->id;
        
         $c = Course::find($id);
         $curr = currency_convert($c);
              $timezone = timezone($c);
                $d =  teacherDetail($c->user_id);
              $student_text = " ";
              $c_date = $timezone->date;
               $c_time = $timezone->time;
            $student_amount =0;

        $course  = StudentCourse::where('course_id',$id)->where('user_id',Auth::user()->id)->where('status','done')->first();
         if($c->type =='Live' && $c->price_type =='paid'){
             
                
                 $start_date = new DateTime($c->date);
                        
                $since_start = $start_date->diff(new DateTime('NOW'));

                if($since_start->invert >0){

                   $charge  = Charge::where('course_id',$id)->where('user_id',Auth::user()->id)->where('status',1)->first();

                   $amount = $c->price;
                   if($c->discount){
                        $amount = $amount - ($c->discount*$amount)/100;
                   }

                   // $cent = currency(0.50, 'SGD',  $curr->currency->code,$format = false);

                   $fee = round((6*$amount)/100,2) ;
                   // $fee_amount =$cent+ $fee;
                   $student_amount = $amount-$fee;

                    $teacher_amount = (25*$amount)/100;
                     $student_amount =  round(currency($student_amount,$c->currency ,$charge->currency,false),2);
                        // $student_amount =  round($student_amount,2);
                        // $teacher_amount =  round(currency($teacher_amount, $c->currency, 'SGD',false),2);
                            // dd($student_amount);
                        // if($student_amount < 1){
                        //   $student_amount = 100;
                        // }
                        // dd($amount,$fee_amount,$student_amount);
                       
                        if($since_start->days > 0){
                       // $cc =      $stripe->charges->retrieve( $charge->charge_id,);
                             // dd($cc); 
                  if($charge){
                            if($d->country !='IN'){
                       $cc = $stripe->charges->retrieve( $charge->charge_id,);

                           $ch  =    $stripe->refunds->create([  'charge' => $charge->charge_id,'amount'=>$student_amount*100 ]);
                       } else{
                        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

                                $payment = $api->payment->fetch($charge->charge_id);
                             $refund = $payment->refund(array('amount' => $student_amount*100));

                       }
                           // $ch  =    $stripe->refunds->create([  'charge' => $charge->charge_id,'amount'=>$student_amount*100 ]);    
                             $charge->status =  0;
                                         $charge->update();

                                      $symbol = $curr->currency->symbol;
                                       
                                        $student_text = ' Amount Refunded :  <b>'.$student_amount.' '.strtoupper($charge->currency).'</b>';
                                     $mail['details'] = [
                                                    'heading'=>'Hi '.ucfirst(Auth::user()->name),
                                                      'description'=>'We noted your cancellation and have processed '.$symbol.' '.$student_amount.' refund to your card. Refer to the invoice below',
                                                       'instructor'=>Auth::user()->name,
                                                            'title'=>$c->title,
                                                            'image'=>$c->image,
                                                            'date'=>$c_date,
                                                            'time'=>$c_time,
                                                            'desc'=>$c->desciption,
                                                            'btn'=>'Join Class',
                                                              'rating'=>intval($d->rating),
                                                            'price'=>$curr->html,
                                                            'fee'=>$fee,
                                                            'symbol'=>$symbol,
                                                            'charge'=>($student_amount),
                                                            'url'=>url('class/'.$c->slug),
                                                     ];
   
                                       // \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\StudentCancel($details));
                                                Mail::send('mail.student_invoice', $mail, function($message) {
                                                         $message->to(Auth::user()->email)->subject
                                                            ('Your enrolment for class is successfully cancelled');
                                                         
                                                      });
                        }

                                        
                        }  else {

                                            $charge->status =  0;
                                            $charge->update();
                                          $student_text = ' Amount Refunded :<b> 0 </b> ';


                                               $mail = [
                                            'subject' => 'Your enrolment for '.$c->title.' is successfully cancelled ',
                                            'heading'=>'Hi '.ucfirst(Auth::user()->name).'!',
                                            'description'=>'We observed that you cancelled the class within 24 hrs of scheduled class start time, hence we are afraid you will not be eligible for a refund.',
                                            'id'=>$c->id,
                                            'instructor'=>Auth::user()->name,
                                            'title'=>$c->title,
                                            'image'=>$c->image,
                                            'date'=>$c_date,
                                            'time'=>$c_time,
                                            'desc'=>'',
                                            'btn'=>'',
                                              'rating'=>intval($d->rating),
                                            'price'=>$curr->html,
                                            'url'=>url('class/'.$c->slug),
                                            
                                        ];
                             
                                         \Mail::to(Auth::user()->email)->send(new \App\Mail\StudentCancel($mail));
                        }

                            //Teacher  transfer 

                         $teacher = Teacher::where('user_id',$c->user_id)->first();
                          // dd($teacher);
                            // \Stripe\Transfer::create([
                            //   "amount" =>$teacher_amount*100,
                            //   "currency" => "sgd",
                            //   "destination" => $teacher->account_id,
                            //   "transfer_group" => "Student Cancel course refund"
                            // ]);
                             

                        
                }



        }

        $course->status = 'pending';
        $course->update();

        $user = User::find($c->user_id);

         $details = [
            'n_title' => 'Hi Yocolab',
            'title' => '<font color="red"> Alert </font>',
            'message' => '“ '.ucfirst(Auth::user()->name).'“ has cancelled the enrolment for “'.$c->title.'“',
            'actionURL' => url('class/'.$c->slug),
        ];


     $mail = [
        'subject' => ucfirst(Auth::user()->name).' has cancelled the enrollment for '.$c->title,
        'heading'=>'Oops !',
        'description'=> ucfirst(Auth::user()->name).' has decided to opt out of your class '.$c->title,
        'quote'=>'Happy Teaching!',
  
    ];


 \Mail::to($user->email)->send(new \App\Mail\SendEmailTest($mail));
  
        Notification::send($user, new SendNotification($details));

         $user1 = User::find(Auth::id());

         $detail = [
            'n_title' => 'Hi Yocolab',
            'title' => '<font color="red"> Alert </font>',
            'message' =>' You have cancelled the enrolment for "'.$c->title.' "',
            'actionURL' => url('class/'.$c->slug),
        ];
  
        Notification::send($user1, new SendNotification($detail));

          return redirect()->back()->with('success','Your enrollment for the class "'.$c->title.'" has been cancelled successfully.<br>'.$student_text);

    }


    public function profile(Request $request)
    {  
        if($request->isMethod('post')){
            $fname = $request->fname;
            $lname = $request->lname;
            $phone = $request->phone;

             $validated = $request->validate([
                    'fname' => 'required|string|max:255',
                    'lname' => 'required|string|max:255',
                    'phone' => 'numeric|size:10',
                ]);

            $user = User::find(Auth::user()->id);
            if($user->name != $fname.' '.$lname ){
                 $user->name= $fname.' '.$lname;
                $user->phone= $phone;
                    $user->save();
            }
            return redirect()->back()->with('success','Profile is Updated');
        }
      
       return view('student.profile');
    }

    public function report(Request $request)
    {
      
        $data = new Report;
        $data->course_id = $request->id;
        $data->description = $request->description;

            if($request->hasFile('image')){

                $imageName = time().'.'.request()->image->getClientOriginalExtension();

                request()->image->move('storage/report', $imageName);

              

                $data->image = $imageName;
            }

            $data->save();

            return redirect()->back()->with('success','We have received your request and will add the relevant class at the earliest');
    }

    public function test()
    {

        $course = Course::with('user')->find(99);
        $user =Auth::user();
        // dd($course->user->name);
 
          
           $details = [
        'subject' => 'Course Joined',
        'id'=>$course->id,
        'title'=>$course->title,
        'image'=>$course->image,
        'date'=>$course->created_at,
        'user'=>$user->name,

    ];
   
    \Mail::to(Auth::user()->email)->send(new \App\Mail\CourseJoinedMail($details));

    dd('email sent');
    }

    public function feedback($slug)
    { 

        $course = Course::with('user')->where('slug',$slug)->first();
        $s  = StudentCourse::where('user_id',Auth::id())->where('course_id',$course->id)->where('status','done')->first();

       if(!$s){
           abort(404);
       }
      $video_class = VideoClass::where('course_id',$course->id)->first();
      if(!$video_class){
        abort(404);
      }

      $feedback = Feedback::where('user_id',Auth::id())->where('course_id',$video_class->course_id)->first();
         if($feedback){

         return redirect('user/dashboard');
    }
      
      return view('feedback',compact('course'));
    }

    public function submitFeedback(Request $request)
    {
        $validated = $request->validate([
                   'star' => 'required',
                   'description' => 'required',
                ]);
      $data = new Feedback;
      $data->user_id = Auth::user()->id;
      $data->teacher_id = $request->teacher_id;
      $data->course_id = $request->course_id;
         $video_class = VideoClass::where('course_id',$request->course_id)->first();
      $data->star = $request->star;
      $data->feedback = $request->description;
      $data->save();
      $course  = Course::find($request->course_id);
      $user = User::find($request->teacher_id);
       $details = [
            'n_title' => 'Feedback Received',
            'message' => 'You have received a feedback from  “'.Auth::user()->name.' “',
            'title' => 'Feedback from student',
            'actionURL' => url('feedback/'.$video_class->id),
        ];
         Notification::send($user, new SendNotification($details));


      return redirect('/class/'.$course->slug)->with('success','Thanks for your valueable feedback.');
    }

     public function feedbackCheck($id,$uid)
    { 

      $video_class = VideoClass::find($id);
      if(!$video_class){
        abort(404);
      }

       $course = Course::with('user')->find($video_class->course_id);
       $feedback = Feedback::where('user_id',Auth::id())->where('course_id',$video_class->course_id)->first();
       if($video_class->user_id == Auth::id()){
         auth()->user()->unreadNotifications->where('id', $uid)->markAsRead();
          return redirect('teacher/my-feedback');
       }
    if($feedback){
       auth()->user()->unreadNotifications->where('id', $uid)->markAsRead();
        return redirect('classs/'.$course->slug);
    }
     return redirect('user/feedback/'.$coures->slug);
    }


        public function teacherRegister(Request $request)
    { 


        $language = Language::whereStatus(1)->get();
        $country = Country::whereStatus(1)->get();

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
            $teacher->category_id = $request->category_id;
            $teacher->currency = $request->currency;
            $teacher->price = $request->price1.'-'.$request->price2;
              $textToStore = nl2br(htmlentities($request->about, ENT_QUOTES, 'UTF-8'));
              // dd($textToStore);
            $teacher->about  = $textToStore;
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
              return redirect('/teacher/profile')->with('success','Congratulations '.$user->name.' ! You are an Instructor now!');

            }

            


        }

      $user = Auth::user();

      if(!$user->hasRole('teacher')){

         return view('teacher.register',compact('language','country'));
      } else {
         return redirect('/');
      }

    }

    public function intrest_submit(Request $request)
    {
     
        $user = User::find(Auth::id());

        $user->interest = implode(';',$request->interest);
        $user->save();

        return redirect()->back();


    }



}

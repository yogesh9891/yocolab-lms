<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

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
use App\Models\RequestClass;


use Razorpay\Api\Api;
use Auth;

class Teacher extends Component
{

    public $data ;
    public $view = 1;
    public $pagePerLimit = 7;
   

    


    public function render()
    {
         $teacher = \App\Models\Teacher::where('user_id',Auth::user()->id)->first();
         if(!$teacher){
            abort(404);
         }
         if($this->view == 1){
            $this->teacher_dashboard();
         }
          
        return view('livewire.teacher');
    }

    public function teacher_dashboard()
    {
        $this->view =1;
 
         $this->data['students'] = StudentCourse::where('teacher_id',Auth::user()->id)->count();
          $this->data['courses'] = Course::where('user_id',Auth::user()->id)->orderBy('date','asc')->count();
          $this->data['material'] = StudyMaterial::where('user_id',Auth::user()->id)->count();
          $this->data['recent_courses'] = Course::with('user','student','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('user_id',Auth::user()->id)->where('type','Live')->where('status',1)->where('date','>=',date('Y-m-d'))->orderBy('date', 'asc')->take(5)->get();


    }


      public function teacher_my_courses()
    {
        $this->view =2;
        $this->data['courses'] =  Course::with('user','student','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('user_id',Auth::user()->id)->where('date','>=',date('Y-m-d'))->where('type','Live')->where('status',1)->orderBy('date', 'asc')->take($this->pagePerLimit)->get();

    }


        public function teacher_courses()
    {
         $this->view =3;
       $this->data['courses'] = Course::with('user','student')->where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->take($this->pagePerLimit)->get();
       
    }  


        public function teacher_study_material()
        {
             $this->view =4;
           $this->data['datas'] = StudyMaterial::with('teacher')->where('user_id',Auth::user()->id)->take($this->pagePerLimit)->get();
             
        }

    public function teacher_my_earning()
    {
         $this->view =8;
      
        $this->data['courses'] = Earning::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->take($this->pagePerLimit)->get();
         
    }

        public function teacher_my_feedback()
        {
             $this->view =5;
          $this->data['feedbacks'] = Feedback::with('user','course')->where('teacher_id',Auth::user()->id)->orderBy('created_at', 'desc')->take($this->pagePerLimit)->get();
              
        }


  public function teacher_followers()
    {
         $this->view =6;
       $this->data['followers'] = FollowTeacher::with('user')->where('teacher_id',Auth::user()->id)->orderBy('created_at','DESC')->take($this->pagePerLimit)->get();

        
    }

      public function requested_class()
    {
         $this->view =9;
       $this->data['request_class'] =  RequestClass::where('teacher_id',Auth::user()->id)->orderBy('created_at', 'desc')->take($this->pagePerLimit)->get();

        
    }

       public function teacher_my_account()
    {
         $this->view =7;

            $api_secret = env('STRIPE_SECRET');
         $api_key = env('STRIPE_KEY');
    

        \Stripe\Stripe::setApiKey ($api_secret);

         $stripe = new \Stripe\StripeClient($api_secret);

          $customer_cards = '';
          $bank_account = '';
           $saved_cards = SaveCards::where('user_id',Auth::user()->id)->first();
           $teacher = \App\Models\Teacher::where('user_id',Auth::user()->id)->first();
           $account_id = $teacher->account_id;
            $this->data['teacher'] = $teacher;
          if($teacher->country !='IN'){

           if($account_id){
            $data =   $stripe->accounts->allExternalAccounts(
                    $account_id,
                    ['object' => 'bank_account', 'limit' => 1]
                  );
            $this->data['bank_account'] = $data->data[0];
           
           }
     } else {
        $res = Http::withBasicAuth(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'))->get('https://api.razorpay.com/v1/fund_accounts/'.$account_id);
                        
                        
            $this->data['bank_account'] =$res->json();
     }
           if($saved_cards){

           $customer =$stripe->customers->retrieve($saved_cards->customer_id);
            $this->data['customer_cards'] = $customer->sources;

         }

    }

    public function load($view)
    {
        $this->pagePerLimit +=6;
             if($view == 2){
            $this->teacher_my_courses();
        } elseif ($view==3) {
            $this->teacher_courses();
        }
        elseif ($view==4) {
            $this->teacher_study_material();
        }
        elseif ($view==5) {
            $this->teacher_my_feedback();
        }
    
    elseif ($view==6) {
            $this->teacher_followers();
        } 
         elseif ($view==8) {
            $this->teacher_my_earning();
        }  elseif ($view==9) {
            $this->requested_class();
        }
    
    

    }

  
}

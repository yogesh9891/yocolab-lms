<?php

namespace App\Http\Livewire;

use Livewire\Component;
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
use App\Models\SaveCards;
use App\Models\Feedback;
use Auth;

class Student extends Component
{

    public $data ;
    public $view = 1;

    public function render()
    {
        if($this->view ==1){

            $this->student_dashboard();

        }
        return view('livewire.student');
    }

    public function student_dashboard()
    {
        $this->view = 1;
        $this->data['students'] = StudentCourse::where('user_id',Auth::user()->id)->count();
            $this->data['teacher'] = FollowTeacher::where('user_id',Auth::user()->id)->count();
            $this->data['bookmark'] = Cart::where('user_id',Auth::user()->id)->count();
             $this->data['recent_courses'] = StudentCourse::with('teacher_details','teacher','course','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->whereHas('course', function($query) {
                  $query->where('date', '>=', date('Y-m-d H:i:s'));
             })->where(['user_id'=>Auth::user()->id,'type'=>'Live','status'=>'done'])->take(5)->get();
    }

   

    public function student_my_course()
    {
        $this->view =2;
          $this->data['stu_courses'] = StudentCourse::with('teacher_details','teacher','course','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->whereHas('course', function($query) {
                  $query->where('date', '>=', date('Y-m-d H:i:s'));
             })->where('user_id',Auth::user()->id)->where('status','done')->paginate(7);
       
    }

    public function student_order()
    {
        $this->view =3;
      $this->data['stu_courses'] = StudentCourse::with('teacher_details','teacher','course')->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(7);
    }

    public function student_followed_instructor()
    {
        $this->view =4;
       $this->data['teachers'] = FollowTeacher::with('teacher_details','teacher')->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
    }


    public function student_wishlist()
    {
        $this->view =5;
        $this->data['stu_courses'] = Cart::with('course')->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
    }

    public function my_cards()
    {
      
                $api_secret = env('STRIPE_SECRET');
             $api_key = env('STRIPE_KEY');
        
               $this->data['customer_cards'] ='';
            \Stripe\Stripe::setApiKey ($api_secret);

             $stripe = new \Stripe\StripeClient($api_secret);

              $customer_cards = '';
               $saved_cards = SaveCards::where('user_id',Auth::user()->id)->first();
               if($saved_cards){

               $customer =$stripe->customers->retrieve($saved_cards->customer_id);
                $this->data['customer_cards'] = $customer->sources;

             }
                

    }

}

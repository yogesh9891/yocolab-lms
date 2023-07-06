<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\course;
use App\Models\VideoClass;
use App\Models\Charge;
use App\Models\User;
use App\Models\SaveCards;
use App\Models\Earning;
use App\Models\StudentCourse;
use App\Notifications\SendNotification;
use \Notification,\Mail,\StdClass;
use Razorpay\Api\Api;

use App\Jobs\TeacherNotAttendMail;
use App\Jobs\StudentRefund;


class TeacherAttendClass implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

public $course;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($course)
    {
        $this->course = $course;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $course = course::find($this->course->id);
        $timezone = timezone($course);
        $curr = currency_convert($course);
       $amount =0;
       $teacher_amount=0;

       $total_amount=0;
       $total_price=0;


       if($course->status!=0){
            $VideoClass = VideoClass::where('course_id',$course->id)->where('status','start')->first();

            if($VideoClass)
            {

                    // Course is paid

                         $api_secret = env('STRIPE_SECRET');
                         \Stripe\Stripe::setApiKey ($api_secret);
                         $stripe = new \Stripe\StripeClient($api_secret);
                        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

                        $amount =$course->price;

                           $currency="";
                              if($course->discount){

                                  $amount = $course->price - ($course->price*$course->discount)/100;
                              }

                        $fee = round((6*$amount)/100,2) ;
               
                        $fee_amount =$amount;

                   
                         $d =  teacherDetail($course->user_id);
                         $StudentCourse = StudentCourse::with('course')->where('course_id',$course->id)->where('status','done')->get();
                        $charges  = Charge::where('course_id',$course->id)->where('status',1)->get();


                          $emailJob = (new StudentRefund($course))->delay(now()->addMinutes(3));
                         dispatch($emailJob);


                        $total_price  = $fee_amount*count($charges);
                         $teacher_amount =round((15*$total_price)/100,2);
                         if($course->price_type =='paid')
                         {

                                             $teacher_amount =  round(currency($teacher_amount, $course->currency,  $course->currency,false),2);
                                             $teacher = SaveCards::where('user_id',$course->user_id)->first();
                                            if($teacher_amount > 0) {
                                                    //    $charge = \Stripe\Charge::create([
                                                    //     'amount' => $teacher_amount*100, // $15.00 this time
                                                    //     'currency' => $course->currency,
                                                    //     'customer' => $teacher->customer_id, // Previously stored, then retrieved
                                                    // ]);
                                                   }


                                                      $earning = new Earning;

                                                    $earning->user_id = $course->user_id;
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


                                     $course->status = 0 ;
                                     $course->update();
                                       if($course->price_type =='paid')
                         {

                                                      $user = User::find($course->user_id);
                                                      $course->student = count($StudentCourse);
                                                      $course->teacher_amount = $teacher_amount;
                                                      $course->total_price = $total_price;
                                                      $course->amount = $amount;

                                                         $emailJob = (new TeacherNotAttendMail($course))->delay(now()->addMinutes(20));
                                                     //    dispatch($emailJob);

                        }
        
            }
       }

    }
}

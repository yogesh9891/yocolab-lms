<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Course;
use App\Models\VideoClass;
use App\Models\Charge;
use App\Models\User;
use App\Models\SaveCards;
use App\Models\Earning;
use App\Models\StudentCourse;
use App\Notifications\SendNotification;
use \Notification,\Mail;
use Razorpay\Api\Api;


class StudentSingleRefund implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     public $charge ;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($charge)
    {
        $this->charge = $charge;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
         
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
           $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

           $course_id = $this->charge->course_id;
           $single_charge = Charge::find($this->charge->id);
           $course =Course::select('user_id')->find($course_id);
           $d =  teacherDetail($course->user_id);

        if($d->country !='IN'){

            $account =$stripe->accounts->retrieve($d->account_id,);
              $currency= $account->default_currency;
             $ch = $stripe->refunds->create([  'charge' => $single_charge->charge_id,'amount'=>$single_charge->amount ]);
                                
             } 
             else {
                
                //RazorPay Refund
                            $payment = $api->payment->fetch($single_charge->charge_id);
                            $refund = $payment->refund(array('amount' => $single_charge->amount));
                                          
             }
                                $single_charge->refund =  1;
                                $single_charge->status =  0;
                                $single_charge->update();
    }
}

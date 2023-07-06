<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\charge;
use App\Models\Teacher;
use App\Models\Earning;

class TeacherPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

public $charge;
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

          $api_key = env('STRIPE_KEY');
          $api_secret = env('STRIPE_SECRET');
          \Stripe\Stripe::setApiKey ($api_secret);
          $stripe = new \Stripe\StripeClient($api_secret);

          $charge = charge::find($this->charge->id);
        

          $teacher = Teacher::where('user_id',$charge->teacher_id)->first();

       if($teacher){

         $account =$stripe->accounts->retrieve($teacher->account_id,);
         $ch =   \Stripe\Transfer::create([
                              "amount" =>$charge->amount,
                              "currency" => $charge->currency,
                              "destination" => $teacher->account_id,
                              "transfer_group" => "Course completed payment"
                            ]);
        $charge->charge_id = $ch->id;
          $charge->update();
         $earning = Earning::where('user_id',$charge->teacher_id)->where('Course_id',$charge->course_id)->first();
         if($earning){
            $earning->status = 'complete';
            $earning->update();
         }
       }
    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailTest;
use Mail;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
         public $timeout = 60;
    /**
     * Create a new job instance.
     *
     * @return void
     */
   public function __construct($details)
    {
        $this->details = $details;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
          $email = new SendEmailTest();

        // Mail::to($this->details['email'])->send($email);

        \Mail::send('mail.invoice', [], function($message) use($input){
                $message->to('yogesh','yogeshkunalsewa@gmail.com')->subject('this is mail test');
            });

        


                                     //     $details = [
                                     //        'subject' => ' Class Cancellation Summary for  '.$course->title.' | Yocolab ',
                                     //        'heading'=>'Below is your cancellation summary. ',
                                     //        'id'=>$course->id,
                                     //        'title'=>$course->title,
                                     //        'image'=>$course->image,
                                     //        'date'=>$c_date,
                                     //        'time'=>$c_time,
                                     //        'qty'=>count($StudentCourse),
                                     //        'cfee'=>$teacher_amount,
                                     //        'total'=>$total_price,
                                     //        'price'=>$amount,

                                            
                                     //    ];
                                     //    if($course->price_type =='paid'){
                                            
                                     //    \Mail::to($user->email)->send(new \App\Mail\TeacherCancelMail($details));
                                     //    // \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\TeacherCancelMail($details));
                                     //    }


                                     //    $detail1 = [
                                     //            'n_title' => 'Hi Yocolab',
                                     //            'title' => '<font color="red">Alert </font>',
                                     //            'message' => 'You have cancelled '.$course->title,
                                     //            'actionURL' => url('class/'.$course->slug),
                                     //        ];
                                     // Notification::send($user, new SendNotification($detail1));

                           // $account =$stripe->accounts->retrieve($d->account_id,);

                     //    foreach ($charges as $charge)
                     // {

                     //            $i++;
                     //             if($d->country !='IN'){
                     //                  $account =$stripe->accounts->retrieve($d->account_id,);
                     //                        $currency= $account->default_currency;
                     //            $ch = $stripe->refunds->create([  'charge' => $charge->charge_id,'amount'=>$charge->amount ]);
                     //             } 
                     //             else {
                     //                            // dd($charge->id);
                     //                             $currency ='INR';
                     //                             $payment = $api->payment->fetch($charge->charge_id);
                     //                            $refund = $payment->refund(array('amount' => $charge->amount));
                     //                        }
                     //            $charge->refund =  1;
                     //            $charge->status =  0;
                     //            $charge->update();
                     //            $user = User::find($charge->user_id);
                     //            $mail['details'] = ['subject' => 'Oops! '.$course->title.' has been cancelled
                     //                                                            ',
                     //                                'heading'=>'Oops, Your Instructor cancelled the class',
                     //                                  'description'=>'We have initiated a full refund of '.$symbol.' '.($charge->amount/100).' and the same will be
                     //                                                    credited to your account within 7-10 working days',
                     //                                   'instructor'=>$d->user->name,
                     //                                        'title'=>$course->title,
                     //                                        'image'=>$course->image,
                     //                                        'date'=>$c_date,
                     //                                        'time'=>$c_time,
                     //                                        'desc'=>$course->desciption,
                     //                                        'btn'=>'Join Class',
                     //                                          'rating'=>intval($d->rating),
                     //                                        'price'=>$curr->html,
                     //                                        'fee'=>$fee,
                     //                                        'symbol'=>$symbol,
                     //                                        'charge'=>($charge->amount/100),
                     //                                        'url'=>url('class/'.$course->slug),
                     //                                 ];

                     //                                     $details = [
                     //                        'n_title' => 'Hi Yocolab',
                     //                        'title' => '<font color="red">Alert </font>',
                     //                        'message' => ' “ '.ucfirst($d->user->name).'“  has cancelled   “'.$course->title.'“',
                     //                        'actionURL' => url('class/'.$course->slug),
                     //                    ];

                     //                         Notification::send($user, new SendNotification($details));
                     //                          Mail::send('mail.course', $mail, function($message) use ($user) {
                     //                                     $message->to($user->email)->subject('Oops! Instructor has cancelled the class .');
                     //                                     // $message->to('yogesh@ebslon.com')->subject('Oops! Instructor has been cancelled .');
                                                         
                     //                                  });



                     //    }

    }
}

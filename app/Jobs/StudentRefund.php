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
use \Notification,\Mail;
use Razorpay\Api\Api;

use App\Jobs\StudentSingleRefund;
use App\Jobs\StudentCancelCourseMail;
use App\Jobs\StudentCancelNotification;

class StudentRefund implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   public $course ;

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
        $course_id = $this->course->id;
         $teacher =  teacherDetail($this->course->user_id);
          $curr = currency_convert($this->course);
          $timezone = timezone($this->course);
        $charges  = Charge::where('course_id',$course_id)->where('status',1)->get();
         foreach ($charges as $charge) {

             $user = User::find($charge->user_id);

                 $mail = [
                 'subject' => 'Oops! '.$this->course->title.' has been cancelled',
                 'heading'=>'Oops, Your Instructor cancelled the class',
                  'description'=>'We have initiated a full refund of '.$teacher->symbol.' '.($charge->amount/100).' and the same will be
                                   credited to your account within 7-10 working days',
                   'instructor'=>$teacher->user->name,
                    'title'=>$this->course->title,
                    'image'=>$this->course->image,
                    'date'=>$timezone->date,
                    'time'=>$timezone->time,
                    'desc'=>$this->course->desciption,
                    'btn'=>'Join Class',
                    'rating'=>intval($teacher->rating),
                     'price'=>$curr->html,
                    'symbol'=>$teacher->symbol,
                    'fee'=>'',
                    'charge'=>($charge->amount/100),
                    'url'=>url('class/'.$this->course->slug),
                    'user_id'=>$charge->user_id,
                    ];


              $notification = [
                     'user_id' => $charge->user_id,
                     'n_title' => 'Hi Yocolab',
                     'title' => '<font color="red">Alert </font>',
                     'message' => ' “ '.ucfirst($teacher->user->name).'“  has cancelled   “'.$this->course->title.'“',
                     'actionURL' => url('class/'.$this->course->slug),
                       ];




            if($user){

             $refundJob = (new StudentSingleRefund($charge))->delay(now()->addSeconds(30));
                     dispatch($refundJob);

              $emailJob = (new StudentCancelCourseMail($mail))->delay(now()->addSeconds(46));
                     dispatch($emailJob);

             $notificationJob = (new StudentCancelNotification($notification))->delay(now()->addSeconds(22));
                     dispatch($notificationJob);

            }
         }

    }
}

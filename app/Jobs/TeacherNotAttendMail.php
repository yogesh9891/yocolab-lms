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


class TeacherNotAttendMail implements ShouldQueue
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
          $teacher = User::find($this->course->user_id);
          $course = Course::find($this->course->id);
            $timezone = timezone($this->course);
              $details = [
                    'subject' => ' Class Cancellation Summary for  '.$course->title.' | Yocolab ',
                    'heading'=>'Below is your cancellation summary. ',
                    'id'=>$course->id,
                     'title'=>$course->title,
                    'image'=>$course->image,
                      'date'=>$timezone->date,
                    'time'=>$timezone->time,
                     'qty'=>$this->course->student,
                     'cfee'=>$this->course->teacher_amount,
                     'total'=>$this->course->total_price,
                     'price'=>$this->course->amount,
                    ];

         $notification = [
                'user_id' => $this->course->user_id,
                 'n_title' => 'Hi Yocolab',
                 'title' => '<font color="red">Alert </font>',
                 'message' => 'You have cancelled '.$course->title,
                'actionURL' => url('class/'.$course->slug),
             ];
                                       
                  \Mail::to($teacher->email)->send(new \App\Mail\TeacherCancelMail($details));
             $notificationJob = (new StudentCancelCourseMail($notification))->delay(now()->addMinutes(5));
                     dispatch($notificationJob);
    }
}

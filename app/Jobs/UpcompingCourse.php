<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Course;
use App\Models\User;
use App\Models\StudentCourse;
use \Mail;
use Carbon\Carbon;

use App\Jobs\UpcomingCourseMail;


class UpcompingCourse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $course;
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
        $course = Course::find($this->course->id);
        if($course->status ==1){

         $timezone = timezone($course);
         $curr = currency_convert($course);
         $c_date = $timezone->date;
         $c_time = $timezone->time;
         $d =  teacherDetail($course->user_id);

        $teacher = User::find($course->user_id);
        $teacher->title = 'Reminder: You have a scheduled class "'.$course->title.'" is scheduled today | Yocolab';



        $mail['details'] = [
                     'id'=>$course->slug,
                     'instructor'=>$teacher->name,
                     'title'=>$course->title,
                      'image'=>$course->image,
                     'date'=>$c_date,
                     'time'=>$c_time,
                     'desc'=>$course->desciption,
                     'btn'=>'Start Class',
                       'rating'=>intval($d->rating),
                     'price'=>$curr->html,
                     'url'=>url('class/'.$course->slug),
                                                
                  ];



              

        Mail::send('mail.upcoming_class', $mail, function($message) use ($teacher) {
             $message->to($teacher->email)->subject
                ($teacher->title);

        });


        $students = StudentCourse::where('course_id',$course->id)->where('status','done')->get();
        if($students){

        foreach($students as $item){

                  $details = [
                     'id'=>$course->slug,
                     'instructor'=>$teacher->name,
                     'title'=>$course->title,
                      'image'=>$course->image,
                     'date'=>$c_date,
                     'time'=>$c_time,
                     'desc'=>$course->desciption,
                     'btn'=>'Join Class',
                       'rating'=>intval($d->rating),
                     'price'=>$curr->html,
                     'user_id'=>$item->user_id,
                     'url'=>url('class/'.$course->slug),
                     'subject' =>'Reminder: Your enrolled class "'.$course->title.'" is scheduled today | Yocolab',
                                                
                  ];
                
            $user = User::find($item->user_id);
            if($user){

                  $emailJob = (new UpcomingCourseMail($details))->delay(Carbon::now()->addSeconds(30));
                     dispatch($emailJob);

            // $user->title = 'Reminder: Your enrolled class "'.$course->title.'" is scheduled today | Yocolab';
            // Mail::send('mail.upcoming_class', $mail, function($message) use ($user) {
            //  $message->to($user->email)->subject
            //     ($user->title);
            //    });
            }
         }
        }
        }

    }
}

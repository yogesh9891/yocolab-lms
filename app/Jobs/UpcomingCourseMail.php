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

class UpcomingCourseMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $details ;



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

         $user = User::find($this->details['user_id']);
         if($user){
            $user->title = $this->details['subject'];
            $mail['details'] =  $this->details;

            
           Mail::send('mail.upcoming_class',$mail, function($message) use ($user) {
             $message->to($user->email)->subject
                ($user->title);
               });
         }

    }
}

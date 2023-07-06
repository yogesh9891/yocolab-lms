<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Notifications\SendNotification;
use \Notification,\Mail;
class StudentCancelCourseMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mail ;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $user = User::find($this->mail['user_id']);

        $mail['details'] = $this->mail;
           Mail::send('mail.course', $mail, function($message) use ($user) {
             $message->to($user->email)->subject('Oops! Instructor has cancelled the class .');
             $message->to('yogesh@ebslon.com')->subject('Oops! Instructor has been cancelled .');
                                                         
             });
    }
}

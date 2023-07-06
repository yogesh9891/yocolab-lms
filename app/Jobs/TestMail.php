<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\SendEmailTest;
class TestMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
 public $details;
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

         \Mail::send('mail.invoice',  $this->details, function($message) {
                $message->to('yogesh@ebslon.com')->subject('this is mail test');
            });
    }
}

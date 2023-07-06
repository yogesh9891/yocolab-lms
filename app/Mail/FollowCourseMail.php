<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FollowCourseMail extends Mailable
{
    use Queueable, SerializesModels;

      public $details = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
           return $this->view('mail.follow_course')
                ->subject($this->details['subject'])
                ->with('details', $this->details);
    }
}

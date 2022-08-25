<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobSubmittedEmailNotificationForEmployer extends Mailable
{
  use Queueable, SerializesModels;
  public $submittedjob;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($submittedjob)
  {
    $this->submittedjob = $submittedjob;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->markdown('emails.job-submitted-employer')->with(
      'submittedjob',
      $this->submittedjob
    );
  }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyJobseekerMail extends Mailable
{
  use Queueable, SerializesModels;
  public $jobseeker;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($jobseeker)
  {
    $this->jobseeker = $jobseeker;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('emails.verifyJobseeker');
  }
}

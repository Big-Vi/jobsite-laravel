<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendJobEmailNotification extends Mailable
{
  use Queueable, SerializesModels;
  public $id;
  public $jobseeker;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($jobseeker, $id)
  {
    $this->id = $id;
    $this->jobseeker = $jobseeker;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->markdown('emails.send-job')->with($this->jobseeker, $this->id);
  }
}

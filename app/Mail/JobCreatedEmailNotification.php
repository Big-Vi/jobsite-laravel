<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobCreatedEmailNotification extends Mailable
{
  use Queueable, SerializesModels;

  public $createdjob;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($createdjob)
  {
    $this->$createdjob = $createdjob;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->markdown('emails.job-created');
  }
}

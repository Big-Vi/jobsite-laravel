<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmployerResetPasswordNotification extends Notification
{
  use Queueable;

  public $token;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($token)
  {
    $this->token = $token;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
    return (new MailMessage())
      ->line(
        "you're receiving this email because we received a password reset request for your account."
      )
      ->action('Reset password', url(route('employer.password.reset', $this->token)))
      ->line('Thank you for password requesr');
  }

  /**
   * Get the array representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
        //
      ];
  }
}

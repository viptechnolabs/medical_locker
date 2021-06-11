<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeEmail extends Notification
{
    use Queueable;

    public $hospital;
    public $six_digit_random_number;

    public function __construct($hospital, $six_digit_random_number)
    {
        //
        //dd($hospital->logo);
        $this->hospital = $hospital;
        $this->six_digit_random_number = $six_digit_random_number;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Verify your email')->view('emails.update_email', [
            'hospital' => $this->hospital,
            'email' => $this->hospital->email,
            'six_digit_random_number' => $this->six_digit_random_number,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

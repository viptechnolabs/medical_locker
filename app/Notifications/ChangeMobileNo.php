<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class ChangeMobileNo extends Notification
{
    use Queueable;

    public $hospital;
    public $six_digit_random_number;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($hospital, $six_digit_random_number)
    {
        //
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
        return ['nexmo'];
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */

    public function toNexmo($notifiable)
    {
        //dd($notifiable);
        return (new NexmoMessage())
            ->content('Your Verification code is' . $this->six_digit_random_number . '.');
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

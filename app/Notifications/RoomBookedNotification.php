<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RoomBookedNotification extends Notification
{
    use Queueable;
    protected $message;
    protected $currentTime;
    protected $customerId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message,$currentTime,$customerId)
    {
        $this->message = $message;
        $this->currentTime = $currentTime;
        $this->customerId=$customerId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'message'=> $this->message,
            'currentTime'=>$this->currentTime,
            'customerId'=>$this->customerId,
        ];
    }
}

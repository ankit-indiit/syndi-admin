<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNotification extends Notification
{
    use Queueable;
   
    public function __construct($msg)
    {
        $this->msg = $msg;
    }
   
    public function via($notifiable)
    {
        return ['database'];
    }
 
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
    
    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->msg['user_id'],
            'link' => '',
            'message' => $this->msg['message'],
        ];
    }
}

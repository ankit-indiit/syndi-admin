<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use AGILEDROP\LaravelTelnyx\Messages\TelnyxSmsMessage;

class SmsNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param string $from
     * @param string $content
     */
    public function __construct(string $from, string $content)
    {
        $this->from = $from;
        $this->content = $content;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['telnyx-sms'];
    }

    /**
     * Get the Telnyx / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return TelnyxSmsMessage
     */
    public function toTelnyx($notifiable): TelnyxSmsMessage
    {
        return (new TelnyxSmsMessage())
           ->from($this->from)
           ->content($this->content);
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

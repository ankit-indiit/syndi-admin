<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\Msg;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $sender_phone;
    public $sender_name;
    public $receiver_phone;
    public $receiver_name;
    public $message;
    public $created_at;
    public $imageUrls;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($sender_phone, $sender_name, $receiver_phone, $receiver_name, $message, $created_at, $imageUrls)
    {
        $this->sender_phone = $sender_phone;
        $this->sender_name = $sender_name;
        $this->receiver_phone = $receiver_phone;
        $this->receiver_name = $receiver_name;
        $this->message = $message;
        $this->created_at = $created_at;
        $this->imageUrls = $imageUrls;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('msg.'.$this->sender_phone);
        return new Channel('chat-room');
    }

    public function broadcastWith()
    {
        return [
            'sender_phone' => $this->sender_phone,
            'sender_name' => $this->sender_name,
            'receiver_phone' => $this->receiver_phone,
            'receiver_name' => $this->receiver_name,
            'message' => $this->message,
            'created_at' => $this->created_at,
            'imgs' => $this->imageUrls,
        ];
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'chat-event';
    }
}

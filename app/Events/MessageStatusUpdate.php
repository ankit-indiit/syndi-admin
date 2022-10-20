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

class MessageStatusUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public string $message;
    public string $sender_phone;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $sender_phone, string $message)
    {
        $this->sender_phone = $sender_phone;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('chat-room');
        // return new PrivateChannel('msg.'.$this->sender_phone);
        // return ['chat-room'];
        return new Channel('chat-room');
    }

    public function broadcastWith()
    {
        return [
            'sender_phone' => $this->sender_phone,
            'message' => $this->message
        ];
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        //return 'message';
    }

}

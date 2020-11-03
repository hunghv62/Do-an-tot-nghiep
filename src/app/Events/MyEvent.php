<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\PrivateChannel;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user_created;
    public $room_id;

    public function __construct($message, $user_created, $room_id)
    {
        $this->message = $message;
        $this->user_created = $user_created;
        $this->room_id = $room_id;
    }

    public function broadcastOn()
    {
//        return new Channel('my-channel');
        return new PrivateChannel('message.' . $this->room_id);
    }

    public function broadcastAs()
    {
        return 'my-event';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'user_created' => $this->user_created,
            'room_id' => $this->room_id,
        ];
    }
}

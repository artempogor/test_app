<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;

    public Message $message;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Message $message)
    {
        $this->user = $user;

        $this->message = $message;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('chat');
    }
}
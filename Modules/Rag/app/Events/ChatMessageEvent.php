<?php

namespace Modules\Rag\app\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $response;
    public $sessionId;

    /**
     * Create a new event instance.
     *
     * @param string $sessionId User's session ID for channel isolation
     * @param string $response AI response message
     */
    public function __construct(string $sessionId, string $response)
    {
        $this->sessionId = $sessionId;
        $this->response = $response;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        // Each user gets their own channel based on session ID
        return new Channel('chat.' . $this->sessionId);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'message.received';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'response' => $this->response,
        ];
    }
}

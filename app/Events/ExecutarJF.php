<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ExecutarJF implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $turma;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id_turma)
    {
        $this->turma = $id_turma;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('executarJF');
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Bets implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $sSample;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($sSample)
    {
        $this->sSample = $sSample;
    }

    public function broadcastWith()
    {
        return [
            'it' => 'works',
            'sample' => $this->sSample
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('bets');
    }
}

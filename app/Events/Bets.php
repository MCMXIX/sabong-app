<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Bets
 * @package App\Events\
 * @since 2022.04.14
 * @version 1.0
 */
class Bets implements ShouldBroadcast
{
    use InteractsWithSockets, Dispatchable, SerializesModels;

    /**
     * @param array
     */
    private $aFightInfo;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $aFightInfo)
    {
        $this->aFightInfo = $aFightInfo;
    }

    /**
     * broadcastWith
     * @return array
     */
    public function broadcastWith() : array
    {
        return $this->aFightInfo;
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

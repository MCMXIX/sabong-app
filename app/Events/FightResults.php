<?php

namespace App\Events;

use App\Services\Fight\Models\FightModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * FightResults
 * @package App\Events\
 * @since 2022.04.12
 * @version 1.0
 */
class FightResults implements ShouldBroadcast
{
    use InteractsWithSockets, Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * broadcastWith
     * @return array
     */
    public function broadcastWith() : array
    {
        return $this->getAllFights();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('fightResults');
    }

    /**
     * getallFights
     * @return array
     */
    private function getAllFights() : array
    {
        $oFightModel = new FightModel();
        return $oFightModel->getFightResults();
    }
}

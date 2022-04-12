<?php

namespace App\Events;

use App\Services\Fight\Models\FightModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class Bets implements ShouldBroadcast
{
    use InteractsWithSockets, Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //TODO :: UPDATE THIS CLASS
    }

    /**
     * broadcastWith
     * @return array
     */
    public function broadcastWith() : array
    {
        return $this->getCurrentFightInfo();
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

    /**
     * getCurrentFightInfo
     * @return array
     */
    private function getCurrentFightInfo() : array
    {
        $oFightModel = new FightModel();
        $aFightInfo = $oFightModel->getCurrentFight();
        if (empty($aFightInfo) === true) {
            return [];
        }
        
        return [
            'fight_no'   => Arr::get($aFightInfo, 'fight_no', 1),
            'status'     => Arr::get($aFightInfo, 'status', ''),
            'wala_bets'  => $this->getSideTotalBet($aFightInfo, 'W'),
            'meron_bets' => $this->getSideTotalBet($aFightInfo, 'M')
        ];
    }

    /**
     * getSideTotalBet
     * @param array $aFightInfo
     * @param string $sSide
     * @return int
     */
    private function getSideTotalBet(array $aFightInfo, string $sSide) :int
    {
        $aBets = Arr::where(Arr::get($aFightInfo, 'bets', []), function($aBet) use($sSide) {
            return $aBet['side'] === $sSide;
        });

        return array_sum(array_column($aBets, 'amount'));
    }
}

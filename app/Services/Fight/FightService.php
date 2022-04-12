<?php

namespace App\Services\Fight;

use App\Events\Bets;
use App\Events\FightResults;
use App\Services\Fight\Models\FightModel;
use Illuminate\Support\Arr;

/**
 * FightService
 * @package App\Services\Fight\
 * @since 2022.04.04
 * @version 1.0
 */
class FightService
{
    /**
     * @var FightModel
     */
    private $oFightModel;

    /**
     * FightService constructor.
     * @param FightModel $oFightModel
     */
    public function __construct(FightModel $oFightModel)
    {
        $this->oFightModel = $oFightModel;
    }
    
    /**
     * getFightByNo
     * @param int $iNumber
     * @return array
     */
    public function getFightByNo(int $iNumber) : array
    {
        return $this->oFightModel->getFightByNo($iNumber);
    }

    /**
     * createCurrentFight
     * @return array
     */
    public function createCurrentFight() : array
    {
        $bResult = $this->createFight([
            'user_id' => session('user_id'),
            'status'  => 'O'
        ]);

        if ($bResult === true) {
            $aFightInfo = $this->getFightInfo();
            //TODO: CHECK IF THIS IS NECCESSARY
            broadcast(new Bets());
            return $aFightInfo;
        }

        return [
            'code' => 400,
            'data' => [
                'message' => 'There is fight still on going. Please mark the current fight done to proceed'
            ]
        ];
    }

    /**
     * updateFight
     * @param array $aParameters
     * @return array
     */
    public function updateFight(array $aParameters) : array
    {
        $aParameters['user_id'] = session('user_id');
        $iFightNo = (int)Arr::pull($aParameters, 'fight_no');
        if ($this->oFightModel->updateFight($iFightNo, $aParameters) < 1) {
            return [
                'code' => 404,
                'data' => [
                    'message' => 'Fight doesn\'t exist!'
                ]
            ];
        }   
        
        if (Arr::has($aParameters, 'game_winner') === true) {
            if ($this->createFight(['user_id' => $aParameters['user_id']]) === false) {
                return [
                    'code' => 400,
                    'data' => [
                        'message' => 'There is fight still on going. Please mark the current fight done to proceed'
                    ]
                ];
            }
        }

        $aFightInfo = $this->getFightInfo();
        //TODO : CHECK IF THIS IS NECCESSARY
        broadcast(new Bets());
    
        return $aFightInfo;
    }

    /**
     * createFight
     * @param array $aParameters
     * @return bool
     */
    private function createFight(array $aParameters) : bool
    {
        if (empty($this->oFightModel->getOpenFights()) === false) {
            return false;
        }
        
        $this->oFightModel->createFight($aParameters);
        broadcast(new FightResults());

        return true;
    }

    /**
     * getFightInfo
     * @return array
     */
    public function getFightInfo() : array
    {
        $aFightInfo = $this->oFightModel->getCurrentFight();
    
        return [
            'code' => 200,
            'data' => [
                'fight_no'   => Arr::get($aFightInfo, 'fight_no', 1),
                'status'     => Arr::get($aFightInfo, 'status', ''),
                'wala_bets'  => $this->getSideTotalBet($aFightInfo, 'W'),
                'meron_bets' => $this->getSideTotalBet($aFightInfo, 'M')
            ]
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

    /**
     * getFightResults
     * @return array
     */
    public function getFightResults() : array
    {
        return [
            'code' => 200,
            'data' => $this->oFightModel->getFightResults()
        ];
    }
}
<?php

namespace App\Services\Bet;

use App\Services\Bet\Models\BetModel;
use App\Services\Fight\FightService;
use Illuminate\Support\Arr;

/**
 * BetService
 * @package App\Services\Bet\
 * @since 2022.04.03
 * @version 1.0
 */
class BetService
{
    /**
     * @var BetModel
     */
    private $oBetModel;

    /**
     * @var FightService
     */
    private $oFightService;

    /**
     * BetService constructor.
     * @param BetModel $oBetModel
     */
    public function __construct(BetModel $oBetModel)
    {
        $this->oBetModel = $oBetModel;
    }

    /**
     * setFightservice
     * @param FightService $oFightService
     */
    public function setFightService(FightService $oFightService)
    {
        $this->oFightService = $oFightService;
    }

    /**
     * addBet
     * @param array $aParameter
     * @return array
     */
    public function addBet(array $aParameter) : array
    {
        $aFightStatus = $this->checkFightStatus($aParameter['fight_no']);
        if (Arr::get($aFightStatus, 'status', false) === false) {
            return [
                'code'    => 422,
                'message' => $aFightStatus['message']
            ];
        }
        
        $aParameter['status'] = 'F';
        $aParameter['user_id'] = session('user_id');
        $aBet = $this->oBetModel->addBet($aParameter);

        $this->generateReciept();
        //TODO : WebSocket Update Data from vuex

        return [
            'code'    => 200,
            'message' => 'Succefully bet!'
        ];
    }

    /**
     * checkFightStatus
     * @param int $iFightNo
     * @return array
     */
    private function checkFightStatus(int $iFightNo) : array
    {
        $aFight = $this->oFightService->getFightByNo($iFightNo);
        if (empty($aFight) === true) {
            return [
                'status'  => false,
                'message' => 'Fight does\'t exist.'
            ];
        }

        $aFight = Arr::first($aFight);
        if ($aFight['status'] !== 'O') {
            return [
                'status'  => false,
                'message' => 'Fight is either Closed or Done.'
            ];
        }

        return ['status' => true];
    }

    private function generateReciept()
    {
        //TODO : GENERATE RECIEPT FOR BETS
    }
}
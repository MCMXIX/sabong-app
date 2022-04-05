<?php

namespace App\Services\Bet;

use App\Services\Bet\Models\BetModel;
use App\Services\Fight\FightService;
use App\Services\User\UserService;
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
     * @var UserService
     */
    private $oUserService;

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
     * setUserService
     */
    public function setUserService(UserService $oUserService)
    {
        $this->oUserService = $oUserService;
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
                'code' => 422,
                'data' => [
                    'message' => $aFightStatus['message']
                ]
            ];
        }
        
        $aParameter['status'] = 'F';
        $aParameter['user_id'] = session('user_id');
        $aBet = $this->oBetModel->addBet($aParameter);
        //TODO : WebSocket Update Data from vuex

        return [
            'code' => 200,
            'data' => [
                'message'  => 'Succefully bet!',
                'bet_info' => [
                    'fight_no'     => $aParameter['fight_no'],
                    'processed_by' => $this->oUserService->getUsernameById(session('user_id')),
                    'amount'       => $aParameter['amount'],
                    'side'         => ($aParameter['side'] === 'W') ? 'WALA' : 'MERON',
                    'date'         => date('F j, Y, g:i a')
                ]
            ]
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
}
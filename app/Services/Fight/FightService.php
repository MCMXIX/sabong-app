<?php

namespace App\Services\Fight;

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
     * 
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
     * createFight
     * @return array
     */
    public function createFight() : array
    {
        if (empty($this->oFightModel->getOpenFights()) === false) {
            return [
                'code' => 400,
                'data' => [
                    'message' => 'There is fight still on going. Please mark the current fight done to proceed'
                ]
            ];
        }

        $aFight = $this->oFightModel->createFight(['user_id' => session('user_id')]);
        //TODO : WEBSOCKET

        return [
            'code' => 200,
            'data' => [
                'message' => 'Created successfully.'
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
        $iFightNo = Arr::pull($aParameters, 'fight_no');
        if ((int)$this->oFightModel->updateFight($iFightNo, $aParameters) < 1) {
            return [
                'code' => 404,
                'data' => [
                    'message' => 'Fight doesn\'t exist!'
                ]
            ];
        }
        
        //TODO : WEBSOCKET

        return [
            'code' => 200,
            'data' => [
                'message' => 'Updated successfully.'
            ]
        ];
    }
}
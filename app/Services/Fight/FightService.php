<?php

namespace App\Services\Fight;

use App\Services\Fight\Models\FightModel;

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
}
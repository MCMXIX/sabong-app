<?php

namespace App\Services\Fight\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * FightModel
 * @package App\Services\Fight\Models\
 * @since 2022.04.04
 * @version 1.0
 */
class FightModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'fights';

    /**
     * @var string
     */
    protected $primaryKey = 'fight_no';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'game_winner'
    ];

    /**
     * getFightByNo
     * @param int $iNumber
     * @return array
     */
    public function getFightByNo(int $iNumber) : array
    {
        return $this->where('fight_no', $iNumber)->get()->toArray();
    }

    /**
     * createFight
     * @param array $aParameters
     * @return mix
     */
    public function createFight(array $aParameters)
    {
        return $this->create($aParameters)->toArray();
    }

    /**
     * getOpenFights
     * @param string $sStatus
     * @return array
     */
    public function getOpenFights() : array
    {
        return $this->whereIn('status', ['O', 'C'])->orWhereNull('status')->get()->toArray();
    }

    /**
     * updateFight
     * @param int $iFightNo
     * @param array $aParameters
     * @return int
     */
    public function updateFight(int $iFightNo, array $aParameters) : int
    {
        return $this->where('fight_no', $iFightNo)->update($aParameters);
    }
}
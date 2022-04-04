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
     * getFightByNo
     * @param int $iNumber
     * @return array
     */
    public function getFightByNo(int $iNumber) : array
    {
        return $this->where('fight_no', $iNumber)->get()->toArray();
    }
}
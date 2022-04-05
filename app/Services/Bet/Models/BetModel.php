<?php

namespace App\Services\Bet\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * BetModel
 * @package App\Services\Bet\Models\
 * @since 2022.04.03
 * @version 1.0
 */
class BetModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'bets';

    /**
     * @var string
     */
    protected $primaryKey = 'bet_no';

    /**
     * @var array
     */
    protected $fillable = [
        'fight_no',
        'user_id',
        'amount',
        'side',
        'status'
    ];

    /**
     * addBet
     * @param array $aParameter
     * @return array
     */
    public function addBet(array $aParameter) : array
    {
        return $this->create($aParameter)->toArray();
    }
}
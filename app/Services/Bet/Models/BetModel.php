<?php

namespace App\Services\Bet\Models;

use App\Services\Fight\Models\FightModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * fight
     * @return BelongsTo
     */
    public function fight() : BelongsTo
    {
        return $this->belongsTo(FightModel::class);
    }

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
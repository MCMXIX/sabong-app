<?php

namespace App\Services\Bet\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Bet\BetService;
use App\Services\Bet\Requests\AddBetRequest;
use App\Services\Fight\FightService;
use App\Services\Fight\Models\FightModel;
use App\Services\User\Models\UserModel;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

/**
 * BetController
 * @package App\Services\Bet\Controllers\
 * @since 2022.04.03
 * @version 1.0
 */
class BetController extends Controller
{
    /**
     * @var BetService
     */
    private $oBetService;

    /**
     * BetController constructor.
     */
    public function __construct(BetService $oBetService)
    {
        $this->oBetService = $oBetService;
        $this->oBetService->setFightService(new FightService(new FightModel()));
    }

    /**
     * addBet
     * @param AddBetRequest $oRequest
     * @return JsonResponse
     */
    public function addBet(AddBetRequest $oRequest) : JsonResponse
    {
        $this->oBetService->setUserService(new UserService(new UserModel()));
        $aResult = $this->oBetService->addBet($oRequest->validated());
        return response()->json($aResult['data'], $aResult['code']);
    }
}
<?php

namespace App\Services\Fight\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Fight\FightService;
use App\Services\Fight\Requests\UpdateFightRequest;
use Illuminate\Http\JsonResponse;

/**
 * FightController
 * @package App\Services\Fight\Controllers\
 * @since 2022.04.04
 * @version 1.0
 */
class FightController extends Controller
{
    /**
     * @var FightService
     */
    private $oFightService;

    /**
     * FightController constructor.
     * @param FightService $oFightService
     */
    public function __construct(FightService $oFightService)
    {
        $this->oFightService = $oFightService;
    }

    /**
     * addFight
     * @return JsonResponse
     */
    public function addFight() : JsonResponse
    {
        $aResult = $this->oFightService->createFight();
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * updateFight
     * @param UpdateFightRequest $oRequest
     * @return JsonResponse
     */
    public function updateFight(UpdateFightRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oFightService->updateFight($oRequest->validated());
        return response()->json($aResult['data'], $aResult['code']);
    }
}
<?php

namespace App\Services\Fight\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Fight\FightService;
use App\Services\Fight\Requests\UpdateFightRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

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
     * updateFight
     * @param UpdateFightRequest $oRequest
     * @return JsonResponse
     */
    public function updateFight(UpdateFightRequest $oRequest) : JsonResponse
    {
        $aParameters = $oRequest->validated();
        if ($aParameters['fight_no'] === 1 && Arr::has($aParameters, 'game_winner') === false && Arr::has($aParameters, 'status') === false) {
            $aResult = $this->oFightService->createCurrentFight();
        } else {
            $aResult = $this->oFightService->updateFight($aParameters);
        }
        
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * getFightInfo
     * @return JsonResponse
     */
    public function getFightInfo() : JsonResponse
    {
        $aResult = $this->oFightService->getFightInfo();
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * getFightResults
     * @return JsonResponse
     */
    public function getFightResults() : JsonResponse
    {
        $aResult = $this->oFightService->getFightResults();
        return response()->json($aResult['data'], $aResult['code']);
    }
}
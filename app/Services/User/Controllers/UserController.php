<?php

namespace App\Services\User\Controllers;

use App\Http\Controllers\Controller;
use App\Services\User\Requests\UserRequest;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

/**
 * UserController
 * @package App\Services\User\Controllers\
 * @since 2022.04.02
 * @version 1.0
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $oUserService;

    /**
     * UserController constructor.
     */
    public function __construct(UserService $oUserService)
    {
        $this->oUserService = $oUserService;
    }

    /**
     * createUser
     * @param UserRequest $oRequest
     * @return JsonResponse
     */
    public function createUser(UserRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oUserService->createUser($oRequest->validated());
        return response()->json($aResult['message'], $aResult['code']);
    }

    /**
     * login
     * @param UserRequest $oRequest
     * @return JsonResponse
     */
    public function login(UserRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oUserService->login($oRequest->validated());
        return response()->json($aResult['message'], $aResult['code']);
    }

    /**
     * logout
     */
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
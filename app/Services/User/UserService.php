<?php

namespace App\Services\User;

use App\Services\User\Models\UserModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;

/**
 * UserService
 * @package App\Services\User\
 * @since 2022.03.02
 * @version 1.0
 */
class UserService
{
    /**
     * @var UserModel
     */
    private $oUserModel;

    /**
     * UserService constructor.
     */
    public function __construct(UserModel $oUserModel)
    {
        $this->oUserModel = $oUserModel;
    }

    /**
     * createUser
     * @param array $aParameter
     * @return array
     */
    public function createUser(array $aParameter) : array
    {
        $this->oUserModel->createUser($aParameter)->toArray();
        
        return [
            'code'    => 200,
            'message' => 'Successfully Created!'
        ];
    }

    /**
     * login
     * @param array $aParameter
     * @return array
     */
    public function login(array $aParameter) : array
    {
        $aUser = $this->oUserModel->getUserByUsername($aParameter['username']);
        if (empty($aUser) === true) {
            return [
                'code'    => 404,
                'message' => 'User doesn\'t exist!'
            ];
        }

        if ($aParameter['password'] !== Crypt::decrypt(Arr::first($aUser)['password'])) {
            return [
                'code'    => 401,
                'message' => 'Username or password is incorrect!'
            ];
        }
        
        session(['user_id' => $aUser[0]['user_id']]);

        return [
            'code'    => 200,
            'message' => 'Login success'
        ];
    }

    /**
     * getUsernameById
     * @param int $iUserId
     * @return string
     */
    public function getUsernameById(int $iUserId) : string
    {
        $aUser = $this->oUserModel->getUsernameById($iUserId);
        return Arr::get(Arr::first($aUser), 'username', '');
    }
}
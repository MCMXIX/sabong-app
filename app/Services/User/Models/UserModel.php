<?php

namespace App\Services\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

/**
 * UserModel
 * @package App\Services\User\Models\
 * @since 2022.04.02
 * @version 1.0
 */
class UserModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'user';

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var array
     */
    protected $fillable = ['username', 'password'];

    /**
     * @const null
     */
    const UPDATED_AT = null;

    /**
     * setPasswordAttribute
     * encrypt the user's password
     * @param $sValue
     */
    public function setPasswordAttribute($sValue)
    {
        $this->attributes['password'] = Crypt::encrypt($sValue);
    }

    /**
     * createUser
     * @param array $aParameter
     * @return mix
     */
    public function createUser(array $aParameter)
    {
        return $this->create($aParameter);
    }

    /**
     * getUserByUsername
     * @param string $sUsername
     * @return array
     */
    public function getUserByUsername(string $sUsername) : array
    {
        return $this->where('username', $sUsername)->get()->toArray();
    }

    /**
     * getUsernameById
     * @param int $iUserId
     * @return array
     */
    public function getUsernameById(int $iUserId) : array
    {
        return $this->where('user_id', $iUserId)->get()->toArray();
    }
}
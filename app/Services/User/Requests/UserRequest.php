<?php

namespace App\Services\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UserRequest
 * @package App\Services\User\Requests\
 * @since 2022.04.02
 * @version 1.0
 */
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:150',
            'password' => 'required|string|max:150'
        ];
    }
}
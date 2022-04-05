<?php

namespace App\Services\Bet\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * AddBetRequest
 * @package App\Services\User\Requests\
 * @since 2022.04.04
 * @version 1.0
 */
class AddBetRequest extends FormRequest
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
            'fight_no' => 'required|integer',
            'amount'   => 'required|integer|digits_between:3,10',
            'side'     => 'required|in:M,W'
        ];
    }
}
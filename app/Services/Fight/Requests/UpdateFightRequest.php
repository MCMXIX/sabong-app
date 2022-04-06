<?php

namespace App\Services\Fight\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateFightRequest
 * @package App\Services\Fight\Requests\
 * @since 2022.04.04
 * @version 1.0
 */
class UpdateFightRequest extends FormRequest
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
            'fight_no'    => 'required|integer',
            'status'      => 'required|in:O,C,D',
            'game_winner' => 'sometimes|required|in:W,M,D'
        ];
    }
}
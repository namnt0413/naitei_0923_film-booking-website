<?php

namespace App\Http\Requests\Seat;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'number' => 'required|integer',
            'room_id' => 'required|integer|min:0|exists:rooms,id',
            'price_ratio' => 'required|numeric|min:1',
            'type' => 'required|string|in:vip,couple,normal',
        ];
    }
}

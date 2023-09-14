<?php

namespace App\Http\Requests\Screening;

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
            'film_id' => 'required|integer|min:0|exists:films,id',
            'room_id' => 'required|integer|min:0|exists:rooms,id',
            'total' => 'required|integer|min:1|max:50',
            'start_time' => 'required|date_format:Y-m-d H:i:s|before:end_time',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
        ];
    }
}

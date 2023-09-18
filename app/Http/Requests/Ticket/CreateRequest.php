<?php

namespace App\Http\Requests\Ticket;

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
            'screening_id' => 'required|integer|min:0|exists:screenings,id',
            'seat_id' => 'required|integer|min:0|exists:seats,id',
        ];
    }
}

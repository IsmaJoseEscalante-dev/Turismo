<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
            'user_id' => 'required|exists:App\Models\User,id',
            'tour_id' => 'required|exists:App\Models\Tour,id',
            'quantity' => 'required|numeric',
            'date' => 'required|date|after:today',
            'names' => 'array',
            'names.*.name' => 'required|string',
            'names.*.lastName' => 'required|string',
            'total' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'names.*.name.required' => 'Por favor llene los campos con los nombres',
            'names.*.lastName.required' => 'Por favor llene los campos con los apellidos',
        ];
    }
}

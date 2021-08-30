<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

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
            'cartable_type' => 'required',
            'cartable_id' => 'required',
            'quantity' => 'required|numeric',
            'date' => 'required|date|after:today',
            'names' => 'array',
            'names.*.name' => 'required|string',
            'names.*.lastName' => 'required|string',
            'total' => 'required|numeric'
        ];
    }
}

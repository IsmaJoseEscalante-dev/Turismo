<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => 'required',
            /* 'slug' => [
                'required',
                Rule::unique('tours')->ignore($this->id),
            ], */
            'image' => 'mimes:jpeg,png',
            'amount' => 'required|numeric',
            'description' => 'required'
            //chuuu que fue men...a dsfdsafds

        ];
    }
}

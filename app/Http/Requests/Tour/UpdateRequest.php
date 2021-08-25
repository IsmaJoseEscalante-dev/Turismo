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
            'slug' => [
                'required',
                Rule::unique('tours')->ignore($this->tour->id),
            ],
            'amount' => 'required|numeric',
            'description_tour' => 'required',
            'description_place' => 'required',
            'itinerario' => 'required',
            'services' => 'required',
            'tips' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:App\Models\Category,id'

        ];
    }
}

<?php

namespace App\Http\Requests\Promotion;

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
            'name'=>'required',
            'slug'=>'required',
            'description' => 'required',
            'amount' => 'required',
            'discount' => 'required',
            'date_start' => 'required|date|after:today',
            'date_finish' => 'date|after:today|after_or_equal:start',
            'status'=> 'required|in:available,not_available',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "tours"    => "required|array|min:1",
            "tours.*"  => "required|distinct",
        ];
    }

    public function messages()
    {
        return [
            'date_start.after' => 'La fecha de inicio no puede ser menor a la fecha actual',
            'date_finish.after' => 'La fecha de llegada no puede ser menor a la fecha actual',
            'amount.required' => 'El campo precio no puede estar vacio',
            'date_start.required' => 'El campo fecha de inicio no puede estar vacio',
            'date_finish.required' => 'El campo fecha de llegada no puede estar vacio',
            'description.required' => 'El campo descripcion no puede estar vacio',
            'name.required' => 'El campo titulo no puede estar vacio',
            'tours.required' => 'Debes seleccionar al menos un tour',
            'date_finish.after_or_equal' => 'La fecha de llegada debe ser mayor o igual a la fecha de salida',
        ];
    }
}

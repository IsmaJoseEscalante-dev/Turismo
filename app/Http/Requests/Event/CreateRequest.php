<?php

namespace App\Http\Requests\Event;

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
            'start' => 'required|date|after:today',
            'end' => 'date|after:today|after_or_equal:start',
            'amount' => 'required',
            'description' => 'required',
            'title' => 'required',
            'color' => 'required',
            "tours"    => "required|array|min:1",
            "tours.*"  => "required|distinct",
        ];
    }

    public function messages()
    {
        return [
            'start.after' => 'La fecha de inicio no puede ser menor a la fecha actual',
            'end.after' => 'La fecha de llegada no puede ser menor a la fecha actual',
            'amount.required' => 'Es campo precio no puede estar vacio',
            'start.required' => 'Es campo fecha de inicio no puede estar vacio',
            'end.required' => 'Es campo fecha de llegada no puede estar vacio',
            'description.required' => 'Es campo descripcion no puede estar vacio',
            'title.required' => 'Es campo titulo no puede estar vacio',
            'tours.required' => 'Debes seleccionar al menos un tour',
            'end.after_or_equal' => 'La fecha de llegada debe ser mayor o igual a la fecha de salida'
        ];
    }
}

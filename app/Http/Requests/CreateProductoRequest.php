<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductoRequest extends FormRequest
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
            'name' => 'string|max:255|required',
            'cantidad' => 'integer|nullable',
            'precio' => 'integer|nullable',
            'descripcion' => 'string|max:255||nullable',
            'proveedores_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'proveedores_id.required'  => 'El proveedor es obligatorio.',
        ];
    }
}
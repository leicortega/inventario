<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProveedoresRequest extends FormRequest
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
            'nit' => 'integer|unique:proveedores|nullable',
            'name' => 'required|string|max:255',
            'telefono' => 'integer|nullable',
            'direccion' => 'string|nullable',
            'regimen' => 'string|nullable',
        ];
    }

    public function messages()
    {
        return [
            'nit.unique' => 'Ya existe un Proveedor con este Nit.',
            'name.required'  => 'El nombre es obligatorio.',
        ];
    }
}

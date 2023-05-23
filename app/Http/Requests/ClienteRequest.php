<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'cliente_nombre' => 'required',
            'cliente_nit' => 'required',
            'cliente_direccion' => 'required',
            'cliente_telefono' => 'required',
            'cliente_estado' => 'required',
        ];
    }
}

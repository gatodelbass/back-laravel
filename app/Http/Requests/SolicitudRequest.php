<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudRequest extends FormRequest
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
            'sol_cliente' => 'required',
            'sol_tipo' => 'required',
            'sol_estado' => 'string|nullable',
            'sol_email' => 'required|string',
            'sol_nombresolicitante' => 'required|string',
            'sol_texto' => 'string|nullable',
            'sol_respuesta' => 'string|nullable',
            'sol_fecharespuesta' => 'date|nullable',
        ];
    }
}

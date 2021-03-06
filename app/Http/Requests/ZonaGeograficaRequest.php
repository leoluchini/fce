<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ZonaGeograficaRequest extends Request
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
            'tipo' => 'required',
            'codigo' => 'required',
            'nombre' => 'required',
            'zona_padre_id' => 'required_unless:tipo,pais',
        ];
    }
}

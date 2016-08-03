<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PublicacionRequest extends Request
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
        $rules = array(
            'nombre' => 'required',
            'descripcion' => 'required',
            'palabras_clave' => 'required',
            'anio_publicacion' => 'required',
        );

        if($this->method() == 'POST') 
        {
            $rules['archivo'] = 'required|mimes:pdf';
        }

        return $rules;
    }

    public function attributes()
    {
        return[
            'anio_publicacion' => 'año',
        ];
    }
}

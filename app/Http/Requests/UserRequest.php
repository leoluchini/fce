<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        $validator =  [
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$this->usuarios},id",
        ];
        if($this->method() == "POST"){
            $validator['password'] = 'required|min:6|confirmed';
        }
        return $validator;
    }
}
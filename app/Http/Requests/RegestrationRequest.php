<?php

namespace App\Http\Requests;


class RegestrationRequest extends BaseRequest
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
            'name'=>'required|string|min:6',
            'email' => 'required|string|email|unique:users,email|min:3',
            'password' => 'required|string|min:6'
        ];
    }
}

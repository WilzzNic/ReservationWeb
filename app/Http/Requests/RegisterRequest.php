<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username'  => 'required|unique:users,username',
            'password'  => 'required|confirmed',
            'cust_name' => 'required',
            'gender'    => 'required|size:1',
            'address'   => 'required|max:255',
            'telp_no'   => 'required'
        ];
    }

    public function messages() {
        return [
            
        ];
    }
}

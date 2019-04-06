<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
        $id = $this->input('id');

        return [
            'username'              => 'required|unique:users,username,'. $id .',id',
            'password'              => 'required|confirmed',
            'rest_name'             => 'required',
            'address'               => 'required',
            'telp_no'               => 'required',
            'description'           => 'required',
            'start_time'            => 'required',
            'end_time'              => 'required'
        ];
    }
}

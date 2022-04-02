<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email'=>'required|email|string|max:255|unique:admins,email,'.$this->id,
            'phone_number'=>'required|string|max:255|unique:admins,phone_number,'.$this->id,
            'profile_picture'=>'nullable|image',
            'password'=>'nullable|string|max:255|confirmed',
        ];
    }
}

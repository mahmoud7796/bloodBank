<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequset extends FormRequest
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
            'email'=>'required|email|string|max:255|unique:users,email,'.$this->id,
            'phone_number'=>'required|string|max:255|unique:users,phone_number,'.$this->id,
            'profile_picture'=>'nullable|image',
            'password'=>'nullable|string|max:255|confirmed',
            'date_of_birth'=>'date',
            'last_donate_time'=>'date',
            'blood_type'=>'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'governorate_id'=>'required',
            'city_id'=>'required',
            'available_for_donate'=>'nullable',
        ];
    }
}

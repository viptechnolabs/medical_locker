<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|max:50|min:7|unique:users,email',
            'mobile_no' => 'required|max:13|min:7',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin_code' => 'required|max:10',
            'aadhar_no' => 'required|max:12|min:12|unique:doctors,aadhar_no',
            'gender' => 'required',
            'dob' => 'required',
            'profile_photo' => 'required',
            'document' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'degree' => 'required',
            'specialist' => 'required',
            'email' => 'required|max:50|min:7|unique:doctors,email',
            'mobile_no' => 'required|max:13|min:7',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin_code' => 'required|max:10',
            'aadhar_no' => 'required|max:12',
            'gender' => 'required',
            'dob' => 'required',
            'profile_photo' => 'required',
            'certificates' => 'required',
            'document' => 'required',
        ];
    }
}

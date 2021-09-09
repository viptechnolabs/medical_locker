<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'specialist' => 'required',
            'email' => 'required',
            'mobile_no' => 'required|max:13',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin_code' => 'required|max:10',
            'aadhar_no' => 'required|max:13',
            'dob' => 'required',
        ];
    }
}

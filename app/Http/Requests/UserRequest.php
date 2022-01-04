<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->request->get('id');
        return [
            'name' => 'required',
            'email' => 'email|max:50|unique:users,email,' . $id,
            'mobile_no' => 'required|max:13|min:7',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin_code' => 'required|max:10',
            'aadhar_no' => 'required|max:12|min:12|unique:users,aadhar_no,' . $id,
            'gender' => [Rule::requiredIf(empty($id))],
            'dob' => 'required',
            'profile_photo' => ['mimes:jpeg,png,jpg,svg', Rule::requiredIf(empty($id))],
            'document_photo' => ['mimes:jpeg,png,jpg,svg', Rule::requiredIf(empty($id))],
        ];
    }
}

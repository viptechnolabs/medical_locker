<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'password' => 'min:5',
            'confirm_password' => 'required_with:password|same:password|min:5',
        ];
    }
}

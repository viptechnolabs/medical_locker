<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'hospital_name' => 'required',
            'hospital_details' => 'required',
            'hospital_fex_no' => 'required|max:13',
            'hospital_pin_cord_no' => 'required|max:10',
            'hospital_address' => 'required',
        ];
    }
}

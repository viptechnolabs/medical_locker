<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function rules()
    {
        return [
            'patient_id' => 'required',
            'consultant_doctor' => 'required',
            'routine_checkup' => 'required',
            'type' => 'required',
            'treatment_name' => 'required',
            'insurance' => 'required',
            'consultant_date' => 'required',
            'file' => 'required',
        ];
    }
}

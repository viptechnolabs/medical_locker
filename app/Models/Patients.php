<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'name',
        'mobile_no',
        'email',
        'address',
        'city',
        'state',
        'pin_code',
        'aadhar_no',
        'dob',
        'gender',
        'profile_photo',
        'document_photo',
    ];
}

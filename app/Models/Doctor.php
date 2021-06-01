<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'doctor_id',
        'profile_photo',
        'name',
        'degree',
        'specialist',
        'mobile_no',
        'email',
        'address',
        'city',
        'state',
        'pin_code',
        'aadhar_no',
        'gender',
        'dob',
        'status',
        'password',
    ];
}

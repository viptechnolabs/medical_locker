<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'doctor_id',
        'profile_photo',
        'name',
        'specialist',
        'mobile_no',
        'email',
        'address',
        'city',
        'state',
        'pin_code',
        'aadhar_no',
        'document_photo',
        'gender',
        'dob',
        'status',
        'token',
        'verification_code',
        'password',
    ];

    public function certificate()
    {
        return $this->hasMany(Certificate::class, 'doc_id', 'id');
//        return $this->hasMany(Certificate::class);
    }

    public function patient()
    {
        return $this->hasMany(Report::class, 'consultant_doctor', 'id');
//        return $this->hasMany(Certificate::class);
    }

//    public  static function  getUserById($id){
//        return Doctor::findOrFail($id);
//    }
}

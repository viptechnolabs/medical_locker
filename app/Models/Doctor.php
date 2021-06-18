<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;
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
    public function certificate()
    {
        return $this->hasMany(Certificate::class,'doc_id','id');
//        return $this->hasMany(Certificate::class);
    }


//    public  static function  getUserById($id){
//        return Doctor::findOrFail($id);
//    }
}

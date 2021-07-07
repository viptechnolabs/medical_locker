<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Hospital extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'logo',
        'details',
        'register_no',
        'email',
        'mobile_no',
        'fex_no',
        'address',
        'pin_cord_no',
        'token',
        'verification_code',
        'password',
    ];

    public const GENDER = [
        'male' => 'Male',
        'female' => 'Female',
        'transgender' => 'Transgender',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}

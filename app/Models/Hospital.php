<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}

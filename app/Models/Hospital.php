<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Hospital extends Model
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

}

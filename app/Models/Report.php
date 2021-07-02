<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'consultant_doctor',
        'consultant_date',
        'routine_checkup',
        'type',
        'treatment_name',
        'insurance',
        'file_name',
        'file_path',
    ];

    public function doctor(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Doctor::class, 'id', 'consultant_doctor');
    }

    public function patient(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Patients::class, 'id', 'patient_id');
    }

}

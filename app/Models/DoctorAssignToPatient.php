<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DoctorAssignToPatient extends Pivot
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'assign_date',
        'release_date',
        'doctor_type_for_patient'
    ];

    public function doctors()
    {
        return $this->hasMany(User::class, 'id', 'doctor_id');
    }

    public function patient()
    {
        return $this->hasMany(Patient::class, 'id', 'patient_id');
    }
}

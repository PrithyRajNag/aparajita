<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientAdmitAndDischarge extends Model
{
    protected $fillable = [
        'patient_id',
        'attendee_name',
        'attendee_relation_with_patient',
        'admit_date',
        'admit_time',
        'discharge_date',
        'discharge_time',
        'notes'
    ];

    public function patients() {
        return $this->belongsTo(Patient::class,'id', 'patient_id');
    }
}

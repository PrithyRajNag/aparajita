<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientAppointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'doctor_id',
        'patient_id',
        'organization_id',
    ];

    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function patients() {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function doctors() {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

//    public function doctorInfos() {
//        return $this->belongsTo(DoctorInfo::class, 'user_id','doctor_id');
//    }
}

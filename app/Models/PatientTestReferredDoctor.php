<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientTestReferredDoctor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'institution_name',
        'phone_number',
        'degree',
        'organization_id',
    ];
    public function patientTests()
    {
        return $this->hasMany(PatientTest::class,'id','referred_doctor_id');
    }
}

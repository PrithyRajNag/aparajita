<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientTestItems extends Model
{
    use SoftDeletes;

    protected $fillable = [
//        'input_date',
//        'input_time',
        'delivery_date',
        'delivery_time',
        'price',
        'patient_test_id',
        'test_item_id',
        'lab_staff_id',
        'certify_doctor_id'
    ];

    public function patientTests()
    {
        return $this->belongsTo(PatientTest::class,'patient_test_id','id');
    }

    public function tests()
    {
        return $this->belongsTo(TestItem::class,'test_item_id','id');
    }




}

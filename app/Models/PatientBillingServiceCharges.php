<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientBillingServiceCharges extends Model
{
    protected $fillable = [
        'name',
        'count',
        'date',
        'amount',
        'status',
//        'organization_id',
        'patient_billing_id',
    ];
//    public function organization() {
//        return $this->belongsTo(Organization::class);
//    }
    public function patientBilling()
    {
        return $this->belongsTo(PatientBilling::class,'patient_billing_id','id');
    }
}

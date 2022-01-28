<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PatientBilling extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'patient_billing_no',
        'total_bed_price',
        'total_test_price',
        'total_service_price',
        'sub_total',
        'discount',
        'gross_total',
        'total_paid',
        'slug',
        'status',
        'organization_id',
        'patient_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->patient_billing_no = "100001";
            $last_data_row = static::where('organization_id', auth()->user()->organization_id)->orderBy('id', 'DESC')
                ->first();
            if ($last_data_row != null) {
                $last_patient_billing_no = $last_data_row->patient_billing_no;
                $patient_billing_no = $last_patient_billing_no != NULL
                    ? str_pad((int)$last_patient_billing_no + 1, 6, '0', STR_PAD_LEFT)
                    : str_pad(1, 6, '0', STR_PAD_LEFT);
                $model->patient_billing_no = $patient_billing_no;
            }
            $slug = Str::slug($model->patient_billing_no);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
        static::updating(function($model) {
            $slug = Str::slug($model->patient_billing_no);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });

    }
    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function advanceRecords()
    {
        return $this->hasMany(PatientBillingAdvance::class,'patient_billing_id','id');
    }

    public function serviceRecords()
    {
        return $this->hasMany(PatientBillingServiceCharges::class,'patient_billing_id','id');
    }

    public function patients() {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}

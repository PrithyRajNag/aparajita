<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PatientTest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_test_no',
        'slug',
        'status',
        'organization_id',
        'patient_id',
        'referred_doctor_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->patient_test_no = "000001";
            $last_data_row = static::where('organization_id', auth()->user()->organization_id)->orderBy('id', 'DESC')
                ->first();
            if ($last_data_row != null) {
                $last_patient_test_no = $last_data_row->patient_test_no;
                $patient_test_no = $last_patient_test_no != NULL
                    ? str_pad((int)$last_patient_test_no + 1, 6, '0', STR_PAD_LEFT)
                    : str_pad(1, 6, '0', STR_PAD_LEFT);
                $model->patient_test_no = $patient_test_no;
            }
            $slug = Str::slug($model->patient_test_no);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;

            $unique_id = $slug . $model->freshTimestampString();
            $model->uuid = substr(md5($unique_id), 0, 10);
        });
        static::updating(function($model) {
        $slug = Str::slug($model->patient_test_no);
        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        $model->slug = $count ? "{$slug}-{$count}" : $slug;
    });

    }
    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function patientTestItems()
    {
        return $this->hasMany(PatientTestItems::class,'patient_test_id','id');
    }

    public function patients() {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function labStaff()
    {
        return $this->belongsTo(User::class,'lab_staff_id','id');
    }

    public function referredDoctors()
    {
        return $this->belongsTo(PatientTestReferredDoctor::class,'referred_doctor_id','id');
    }
}

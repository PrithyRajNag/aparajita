<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Patient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'gender',
        'dob',
        'age',
        'image',
        'address',
        'religion',
        'slug',
        'status',
        'is_alive',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $slug = Str::slug($model->first_name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;

            $unique_id = $slug . $model->freshTimestampString();
            $model->uuid = substr(md5($unique_id), 0, 10);
        });
        static::updating(function($model) {
            $slug = Str::slug($model->first_name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });

    }
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    public function bloodGroups()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id', 'id');
    }
    public function patientAdmitDischarges()
    {
        return $this->hasMany(PatientAdmitAndDischarge::class, 'patient_id', 'id');
    }
    public function doctorAssignToPatient(): BelongsTo
    {
        return $this->belongsTo(DoctorAssignToPatient::class, 'id', 'patient_id');
    }

    public function bedAssignToPatient()
    {
        return $this->hasOne(BedAssign::class, 'id', 'bed_assign_id');
    }

    public function patientAppointment()
    {
        return $this->hasMany(PatientAppointment::class, 'id', 'patient_id');
    }
    public function patient_billings()
    {
        return $this->hasMany(PatientBilling::class, 'patient_id', 'id');
    }
    public function patientTests()
    {
        return $this->hasOne(PatientTest::class, 'patient_id', 'id');
    }
//    public function doctorAssignToPatient()
//    {
//        return $this->belongsTo(DoctorAssignToPatient::class, 'id', 'patient_id');
//    }
}

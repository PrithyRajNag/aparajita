<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Birth extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'phone_number',
        'weight',
        'gender',
        'date',
        'time',
        'note',
        'slug',
        'status',
        'organization_id',
        'patient_id',
        'doctor_id',
        'blood_group_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $slug = Str::slug($model->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
        static::updating(function($model) {
            $slug = Str::slug($model->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });

    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    public function doctors() {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
//    public function doctor()
////    {
////        return $this->belongsTo(DoctorInfo::class,'doctor_id','id');
////    }
    public function bloodGroups()
    {
        return $this->belongsTo(BloodGroup::class,'blood_group_id','id');
    }

}

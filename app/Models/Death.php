<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Death extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'time',
        'phone_number',
        'note',
        'slug',
        'status',
        'patient_id',
        'doctor_id',
        'organization_id'
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
}

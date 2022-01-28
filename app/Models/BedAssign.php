<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BedAssign extends Model
{
    use SoftDeletes;

    protected $fillable = [
//        'bed_number',
//        'floor',
//        'price',
        'start_date',
//        'end_date',
//        'description',
//        'slug',
        'status',
        'organization_id',
        'patient_id',
        'bed_list_id',
    ];

//    public static function boot()
//    {
//        parent::boot();
//
//        static::creating(function($model) {
//            $slug = Str::slug($model->bed_number);
//            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
//            $model->slug = $count ? "{$slug}-{$count}" : $slug;
//        });
//        static::updating(function($model) {
//            $slug = Str::slug($model->bed_number);
//            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
//            $model->slug = $count ? "{$slug}-{$count}" : $slug;
//        });
//    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    public function bedList()
    {
        return $this->belongsTo(BedList::class,'bed_list_id','id');
    }
    public function patients()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }

//    public function getFullNameAttribute(): string
//    {
//        return "{$this->first_name} {$this->last_name}";
//    }
}

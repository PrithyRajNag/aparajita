<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BedList extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'bed_number',
        'floor',
        'price',
        'description',
        'slug',
        'is_available',
        'status',
        'organization_id',
        'bed_type_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $slug = Str::slug($model->bed_number);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
        static::updating(function($model) {
            $slug = Str::slug($model->bed_number);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });

    }

    public function bedType()
    {
        return $this->belongsTo(BedType::class,'bed_type_id','id');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}

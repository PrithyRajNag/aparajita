<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TestResultItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'normal_range',
        'unit',
        'slug',
        'status',
        'test_result_category_id',
        'organization_id',
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

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function testResultCategory()
    {
        return $this->belongsTo(TestResultCategory::class);
    }
}

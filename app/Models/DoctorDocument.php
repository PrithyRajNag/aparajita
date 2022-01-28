<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DoctorDocument extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'cover',
        'status',
        'doctor_id',
        'organization_id',

    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $slug = Str::slug($model->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
        static::updating(function($model) {
            $slug = Str::slug($model->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });

    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    public function doctors()
    {
        return $this->belongsTo(User::class, 'id', 'doctor_id');
    }
}

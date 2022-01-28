<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @method static create(array $data)
 */
class BloodInput extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'date',
        'address',
        'phone_number',
        'gender',
        'slug',
        'status',
        'is_regular_donor',
        'organization_id',
        'blood_group_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $slug = Str::slug($model->first_name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
        static::updating(function($model) {
            $slug = Str::slug($model->first_name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });

    }


    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id', 'id');
    }
    public function bloodCollection()
    {
        return $this->hasMany(BloodCollection::class, 'blood_input_id','id');
    }


    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

}

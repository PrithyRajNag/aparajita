<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class CompanyEmployee extends Authenticatable
{
    protected $fillable = [
        'employee_unique_id',
        'first_name',
        'last_name',
        'phone_number',
        'gender',
        'dob',
        'image',
        'address',
        'nid',
        'email',
        'password',
        'nid',
        'status',

    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $slug = Str::slug($model->first_name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;

            $unique_id = $slug . $model->freshTimestampString();
            $model->employee_unique_id = substr(md5($unique_id), 0, 10);
        });
        static::updating(function($model) {
            $slug = Str::slug($model->first_name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });

    }
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function designations() {
        return $this->belongsTo(CompanyDesignation::class, 'company_designation_id', 'id');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}

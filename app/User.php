<?php

namespace App;

use App\Models\Bill;
use App\Models\BloodGroup;
use App\Models\DoctorInfo;
use App\Models\Organization;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;    //for spatie

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_unique_id',
        'first_name',
        'last_name',
        'phone_number',
        'gender',
        'dob',
        'join_date',
        'image',
        'address',
        'email',
        'password',
        'salary',
        'nid',
        'blood_group_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
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
            $model->user_unique_id = substr(md5($unique_id), 0, 10);
//            $model->user_unique_id = $model->id;
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

    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    public function bloodGroups()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id', 'id');
    }
    public function doctorInfos()
    {
        return $this->belongsTo(DoctorInfo::class, 'id','user_id');
    }
    public function bills()
    {
        return $this->hasOne(Bill::class,'user_id' ,'id');
    }
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}

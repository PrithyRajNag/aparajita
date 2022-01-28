<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllDoctorsSchedule extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'week_day',
        'start_time',
        'end_time',
        'patient_limit',
        'doctor_id',
        'organization_id'
    ];

//    public function setWeekDayAttribute($value)
//    {
//        $this->attributes['week_day'] = json_encode($value);
//    }
//
//
//    public function getWeekDayAttribute($value)
//    {
//        return $this->attributes['week_day'] = json_decode($value);
//    }

    public function doctors(){
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
}

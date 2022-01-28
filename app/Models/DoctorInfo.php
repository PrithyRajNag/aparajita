<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DoctorInfo extends Model
{
    protected $fillable = [
        'fees',
        'degree',
        'designation',
        'doctor_category',
        'doctor_type',
        'speciality',
        'user_id',
        'department_id'
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id' ,'id');
    }
    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}

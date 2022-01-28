<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorHoliday extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'doctor_id',
        'start_date',
        'end_date',
        'note',
        'organization_id'
    ];
    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    public function doctors() {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
}

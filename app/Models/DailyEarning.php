<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DailyEarning extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_billing_no',
        'date',
        'amount',
        'user_id',
        'organization_id',
    ];
    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id' ,'id');
    }
}

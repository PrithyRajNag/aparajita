<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsReceiver extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'phone_number',
        'sms_id',
        'organization_id',
    ];
    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function sms()
    {
        return $this->belongsTo(Sms::class,'sms_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationSms extends Model
{
    protected $fillable = [

        'sms_amount',
        'organization_id',
    ];
    public function organization() {
        return $this->belongsTo(Organization::class);
    }
}

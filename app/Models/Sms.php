<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sms extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'receiver',
        'message',
        'status',
        'organization_id',
    ];
    public function organization() {
        return $this->belongsTo(Organization::class);
    }
}

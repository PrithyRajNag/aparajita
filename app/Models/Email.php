<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'email_id',
        'subject',
        'description',
        'status',
        'organization_id',
    ];
    public function organization() {
        return $this->belongsTo(Organization::class);
    }
}

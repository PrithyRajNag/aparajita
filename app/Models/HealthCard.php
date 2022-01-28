<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthCard extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'card_number',
        'issue_date',
        'expire_date',
        'note',
        'patient_id',
        'organization_id',
    ];
    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}

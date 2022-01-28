<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BloodCollection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'bag_number',
        'status',
        'is_available',
        'blood_input_id',
        'blood_group_id',
        'organization_id'
    ];


    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    public function bloodInput()
    {
        return $this->belongsTo(BloodInput::class);
    }
    public function bloodOutput()
    {
        return $this->hasMany(BloodOutput::class);
    }
    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }


}

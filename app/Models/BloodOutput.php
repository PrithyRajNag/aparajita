<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodOutput extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'date',
        'address',
        'phone_number',
        'status',
        'is_patient',
        'organization_id',
        'blood_group_id',
        'blood_collection_id'
    ];
    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id', 'id');
    }
    public function bloodCollection()
    {
        return $this->hasMany(BloodCollection::class, 'id','blood_collection_id');
    }

}

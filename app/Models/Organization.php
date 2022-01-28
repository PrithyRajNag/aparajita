<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'name',
            'logo',
            'address',
            'organization_type',
            'is_one_time_purchase'
        ];

    public function user()
    {
        return $this->hasMany(User::class, 'organization_id', 'id');
    }
    public function bills()
    {
        return $this->hasMany(Bill::class, 'organization_id', 'id');
    }

    public function organizationModules()
    {
        return $this->hasManyThrough(CompanyModule::class, OrganizationModules::class,'organization_id', 'id', 'id', 'module_id');
    }

}

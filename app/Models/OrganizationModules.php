<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationModules extends Model
{
    protected $fillable = ['organization_id', 'module_id'];

    public function organizationModuleIds()
    {
        return $this->where('organization_id', auth()->user()->organizations_id)->pluck('id');
    }

//    public function organizations()
//    {
//        return $this->hasMany()
//    }
}

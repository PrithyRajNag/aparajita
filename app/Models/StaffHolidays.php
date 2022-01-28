<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffHolidays extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'note',
        'organization_id'
    ];
    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

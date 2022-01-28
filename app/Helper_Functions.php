<?php


use App\Models\CompanyModule;
use App\Models\OrganizationModules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;


function hasRole($moduleMethod){
    $count = count(array_diff( Auth::user()->getRoleNames()->toArray(), Config::get('roles.' . $moduleMethod)));

    if ($count == 0) {
        return true;
    }
    return false;
}

//
function checkUserRole($moduleMethod) {
    if (hasRole($moduleMethod)) {
        return true;
    }
    return false;
}

function normalDateFormat($date): string
{
    return Carbon\Carbon::parse($date)->format('d-m-y');
}

function normalTimeFormat($time): string
{
    return Carbon\Carbon::parse($time)->format('h:i:s A');
}

function getRoleName($user)
{
    return $user->roles->first()->name;
}

function checkSalaryPayDate($bill_type, $month, $year)
{
    $now = Carbon\Carbon::now();
    if ($bill_type == 1 && $month == $now->month && $year == $now->year) {
        return true;
    }
    return false;
}

function generateRandomPassword()
{
    return Str::random(8);
}

function getOrganizationModules(){
    return OrganizationModules::where('organization_id', auth()->user()->organization_id)->pluck('module_id')->toArray();
}

function getModuleIdByName($moduleName){
//    return 5;
    return CompanyModule::where('name', $moduleName)->first()->id;

}

function checkOrganizationModuleAccess($moduleName){
    if(in_array(getModuleIdByName($moduleName), getOrganizationModules())) {
        return true;
    }
    return false;
}

//function getUserImage($image)v
//{
//    if ($image == null) {
//        return '/img/male_avatar.png';
//    }
//    return '/storage/images/'. $image;
//}

function getUserImage($image)
{
    if ($image == null) {
        return asset('/img/male_avatar.png');
    }
    return 'data:image;base64,' . $image;
}


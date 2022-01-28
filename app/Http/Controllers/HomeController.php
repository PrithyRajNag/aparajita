<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;  //for Spatie
use Spatie\Permission\Models\Permission;  //for Spatie
use app\User;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
//        Role::create(['name'=>'nurse']);
//        Permission::create(['name'=>'Edit']);

//        $role=Role::findById(1);
//        $permission=Permission::findById(1);
//        $permission->assignRole($role);


//        auth()->user()->assignRole('admin');

//        return auth()->user()->getAllPermissions();

//        return User::role('Admin')->get();

        return view('home');
    }
}

<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $roles = [
            [
                "name" => 'owner',
            ],
            [
                "name" => 'admin',
            ],
            [
                "name" => 'receptionist',
            ],
            [
                "name" => 'doctor',
            ],
            [
                "name" => 'accountant',
            ],
            [
                "name" => 'lab_staff',
            ],
            [
                "name" => 'nurse',
            ],
            [
                "name" => 'other_staff',
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
//        DB::table('roles')->insert([
//            'name'=>'doctor',
//            'guard_name'=>'web'
//        ]);
    }
}

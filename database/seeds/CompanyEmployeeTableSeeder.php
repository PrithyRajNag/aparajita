<?php

use App\Models\CompanyEmployee;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanyEmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'first_name' => 'Nazmul Haque',
                'last_name' => 'Soton',
                'phone_number' => '01745967808',
                'gender' => 'male',
                'dob' => Carbon::createFromFormat('Y-m-d', '1992-05-03'),
                'address' => 'Rajshahi',
                'email' => 'nazmulsoton.isl@gmail.com',
                'password' => '123456789',
//                'nid' => '19926914417000351',
                'company_designation_id' => '4',
            ],
            [
                'first_name' => 'Rony',
                'last_name' => 'Mondol',
                'phone_number' => '07634857236',
                'gender' => 'male',
                'dob' => Carbon::createFromFormat('Y-m-d', '1990-10-18'),
                'address' => 'Rajshahi',
                'email' => 'rony.isl@gmail.com',
                'password' => '123456789',
//                'nid' => '19905901537216',
                'company_designation_id' => '2',
            ],
            [
                'first_name' => 'Prithy Raj',
                'last_name' => 'Nag',
                'phone_number' => '01829823049',
                'gender' => 'male',
                'dob' => Carbon::createFromFormat('Y-m-d', '1996-06-07'),
                'address' => 'Chittagong',
                'email' => 'prn.innovative@gmail.com',
                'password' => '123456789',
//                'nid' => '6865788985',
                'company_designation_id' => '5',
            ],
            [
                'first_name' => 'Payel',
                'last_name' => 'Das',
                'phone_number' => '01680722103',
                'gender' => 'male',
                'dob' => Carbon::createFromFormat('Y-m-d', '1994-07-12'),
                'address' => 'Chittagong',
                'email' => 'john.isl@gmail.com',
                'password' => '123456789',
//                'nid' => '6785264985',
                'company_designation_id' => '3',
            ],

        ];
        foreach ($admins as $admin) {
            CompanyEmployee::create($admin);
        }
    }
}

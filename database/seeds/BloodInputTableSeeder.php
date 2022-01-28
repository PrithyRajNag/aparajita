<?php

use App\Models\BloodCollection;
use App\Models\BloodInput;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BloodInputTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'first_name' => 'Abdul',
                'last_name' => 'Karim',
                'age' => 25,
                'date' => Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                'address' => 'Dhaka',
                'phone_number' => '01711208626',
                'gender' => 'Male',
                'bag_number' => 'A11X11',
                'is_regular_donor' => 1,
                'is_available' => 1,
                'organization_id' => 1,
                'blood_group_id' => 1
            ],
            [
                'first_name' => 'Prithy',
                'last_name' => 'Raj',
                'age' => 27,
                'date' => Carbon::createFromFormat('Y-m-d', '2021-02-02'),
                'address' => 'Chittagong',
                'phone_number' => '01770816000',
                'gender' => 'Male',
                'bag_number' => 'B11X11',
                'is_regular_donor' => 1,
                'is_available' => 1,
                'organization_id' => 1,
                'blood_group_id' => 3
            ],
            [
                'first_name' => 'Nazmul',
                'last_name' => 'Soton',
                'age' => 28,
                'date' => Carbon::createFromFormat('Y-m-d', '2021-03-03'),
                'address' => 'Rajshahi',
                'phone_number' => '01842294284',
                'gender' => 'Male',
                'bag_number' => 'O11X11',
                'is_regular_donor' => 1,
                'is_available' => 1,
                'organization_id' => 1,
                'blood_group_id' => 7

            ],
            [
                'first_name' => 'Khairun',
                'last_name' => 'Nesa',
                'age' => 22,
                'date' => Carbon::createFromFormat('Y-m-d', '2021-04-04'),
                'address' => 'Khulna',
                'phone_number' => '01844444444',
                'gender' => 'Female',
                'bag_number' => 'AB11Y11',
                'is_regular_donor' => 0,
                'is_available' => 1,
                'organization_id' => 3,
                'blood_group_id' => 7
            ]
        ];
        foreach ($datas as $data) {
            $input = BloodInput::create([
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'age'=>$data['age'],
                'date' => $data['date'],
                'address' => $data['address'],
                'phone_number' => $data['phone_number'],
                'gender' => $data['gender'],
                'is_regular_donor' => $data['is_regular_donor'],
                'blood_group_id'=>$data['blood_group_id'],
                'organization_id' => $data['organization_id'],
            ]);
            $collection = BloodCollection::create([
                'blood_input_id' => $input['id'],
                'bag_number'=>$data['bag_number'],
                'is_available'=>$data['is_available'],
                'blood_group_id'=>$data['blood_group_id'],
                'organization_id' => $data['organization_id'],
            ]);
        }
//        BloodCollection::create([
//            'blood_input_id' => 1,
//            'bag_number'=>'nbv54m211',
//            'is_available'=>1,
//            'blood_group_id'=>1,
//            'organization_id' => 1,
//        ]);

    }
}

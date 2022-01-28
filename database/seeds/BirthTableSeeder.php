<?php

use App\Models\Birth;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BirthTableSeeder extends Seeder
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
                'name' => 'Karim',
                'father_name' => 'Abdul',
                'phone_number' => '01821111111',
                'mother_name' => 'Nasrin',
                'weight' => '2',
                'gender' => 'Male',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                'time' => Carbon::createFromFormat('H:i:s', '12:36:10'),
                'note' => 'healthy Baby',
                'address' => 'dhaka',
                'status' => '1',
                'organization_id' => 1,
                'doctor_id' => 1,
                'blood_group_id' => 1
            ],
            [
                'name' => 'Rahim',
                'father_name' => 'Kader',
                'mother_name' => 'Parvin',
                'phone_number' => '01822222222',
                'weight' => '2.3',
                'gender' => 'Male',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-05-04'),
                'time' => Carbon::createFromFormat('H:i:s', '02:45:10'),
                'note' => 'healthy Baby',
                'address' => 'dhaka',
                'status' => '1',
                'organization_id' => 2,
                'doctor_id' => 2,
                'blood_group_id' => 2
            ],

            [
                'name' => 'Khadija',
                'father_name' => 'Amdul',
                'mother_name' => 'Nasrin',
                'phone_number' => '01833333333',
                'weight' => '2.1',
                'gender' => 'Male',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-11-25'),
                'time' => Carbon::createFromFormat('H:i:s', '01:36:10'),
                'note' => 'healthy Baby',
                'address' => 'dhaka',
                'status' => '1',
                'organization_id' => 3,
                'doctor_id' => 2,
                'blood_group_id' => 1
            ]
        ];
        foreach ($datas as $data) {
            Birth::create($data);
        }
    }
}

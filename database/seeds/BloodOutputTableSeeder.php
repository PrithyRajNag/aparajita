<?php

use App\Models\BloodOutput;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BloodOutputTableSeeder extends Seeder
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
                'name' => 'Jobbar Ali',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                'address' => 'Dhaka',
                'phone_number' => '01811111111',
                'is_patient' => 1,
                'organization_id' => 1,
                'blood_group_id' => 1,
                'blood_collection_id' => 1
            ],
            [
                'name' => 'Kuddus Munsi',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-11-11'),
                'address' => 'Chittagong',
                'phone_number' => '01822222222',
                'is_patient' => 0,
                'organization_id' => 1,
                'blood_group_id' => 3,
                'blood_collection_id' => 2
            ],
            [
                'name' => 'Bilkis Begum',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-10-21'),
                'address' => 'Dhaka',
                'phone_number' => '01833333333',
                'is_patient' => 1,
                'organization_id' => 2,
                'blood_group_id' => 7,
                'blood_collection_id' => 3
            ],
            [
                'name' => 'Kulsum Akhtar',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-12-15'),
                'address' => 'Noakhali',
                'phone_number' => '01844444444',
                'is_patient' => 0,
                'organization_id' => 1,
                'blood_group_id' => 6,
                'blood_collection_id' => 4
            ],
        ];
        foreach ($datas as $data) {
            BloodOutput::create($data);
        }
    }
}

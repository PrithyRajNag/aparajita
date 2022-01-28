<?php

use App\Models\Death;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DeathTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas=[
            [
                'phone_number' => '01821111111',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                'time' => Carbon::createFromFormat('H:i:s','12:36:10'),
                'note' => 'heart attack',
                'status' => '1',
                'organization_id' => 2,
                'patient_id' => 1,
                'doctor_id' => 1,
            ],
            [
                'phone_number' => '01822222222',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-11-01'),
                'time' => Carbon::createFromFormat('H:i:s','12:55:10'),
                'note' => 'brain stroke',
                'status' => '1',
                'organization_id' => 1,
                'patient_id' => 2,
                'doctor_id' => 2,
            ],
            [
                'phone_number' => '01823333333',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-21-06'),
                'time' => Carbon::createFromFormat('H:i:s','5:10:10'),
                'note' => 'feaver',
                'status' => '1',
                'organization_id' => 2,
                'patient_id' => 3,
                'doctor_id' => 2,
            ]
        ];
        foreach ($datas as $data) {
            Death::create($data);
        }
    }
}

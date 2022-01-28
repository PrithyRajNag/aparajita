<?php

use App\Models\DoctorHoliday;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DoctorHolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor_holiday=[
            [
                "doctor_id" => 4,
                "start_date" => Carbon::createFromFormat('Y-m-d', '2021-05-01'),
                "end_date" => Carbon::createFromFormat('Y-m-d', '2021-05-04'),
                "note" => "International Worker's Day",
                "organization_id" => 1
            ],
            [
                "doctor_id" => 5,
                "start_date" => Carbon::createFromFormat('Y-m-d', '2021-02-21'),
                "end_date" => Carbon::createFromFormat('Y-m-d', '2021-02-24'),
                "note" => "International Mother Language Day",
                "organization_id" => 2
            ],
            [
                "doctor_id" => 4,
                "start_date" => Carbon::createFromFormat('Y-m-d', '2021-12-16'),
                "end_date" => Carbon::createFromFormat('Y-m-d', '2021-12-17'),
                "note" => "Independence day",
                "organization_id" => 1
            ]
        ];
        foreach ($doctor_holiday as $holiday){
            DoctorHoliday::create($holiday);
        }
    }
}

<?php

use App\Models\StaffHolidays;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StaffHolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff_holiday=[
            [
                "user_id" => 3,
                "start_date" => Carbon::createFromFormat('Y-m-d', '2021-05-01'),
                "end_date" => Carbon::createFromFormat('Y-m-d', '2021-05-04'),
                "note" => "International Worker's Day",
                "organization_id" => 1
            ],
            [
                "user_id" => 6,
                "start_date" => Carbon::createFromFormat('Y-m-d', '2021-02-21'),
                "end_date" => Carbon::createFromFormat('Y-m-d', '2021-02-24'),
                "note" => "International Mother Language Day",
                "organization_id" => 2
            ],
            [
                "user_id" => 7,
                "start_date" => Carbon::createFromFormat('Y-m-d', '2021-12-16'),
                "end_date" => Carbon::createFromFormat('Y-m-d', '2021-12-17'),
                "note" => "Independence day",
                "organization_id" => 1
            ]
        ];
        foreach ($staff_holiday as $holiday){
            StaffHolidays::create($holiday);
        }
    }
}

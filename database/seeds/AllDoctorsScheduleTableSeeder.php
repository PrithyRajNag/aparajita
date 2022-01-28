<?php

use App\Models\AllDoctorsSchedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AllDoctorsScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors_schedule = [
            [
                'week_day' => 'Saturday',
                'start_time' => Carbon::createFromFormat('H:i:s', '8:36:10'),
                'end_time' => Carbon::createFromFormat('H:i:s', '12:50:14'),
                'patient_limit' => '25',
                'organization_id' => 1,
                'doctor_id' => 4,
            ],
            [
                'week_day' => 'Sunday',
                'start_time' => Carbon::createFromFormat('H:i:s', '07:15:10'),
                'end_time' => Carbon::createFromFormat('H:i:s', '11:22:25'),
                'patient_limit' => '22',
                'organization_id' => 1,
                'doctor_id' => 5,
            ],
            [
                'week_day' => 'Monday',
                'start_time' => Carbon::createFromFormat('H:i:s', '09:12:15'),
                'end_time' => Carbon::createFromFormat('H:i:s', '12:40:12'),
                'patient_limit' => '20',
                'organization_id' => 1,
                'doctor_id' => 4,
            ],
            [
                'week_day' => 'Friday',
                'start_time' => Carbon::createFromFormat('H:i:s', '07:15:10'),
                'end_time' => Carbon::createFromFormat('H:i:s', '11:22:25'),
                'patient_limit' => '22',
                'organization_id' => 2,
                'doctor_id' => 3,
            ],
            [
                'week_day' => 'Monday',
                'start_time' => Carbon::createFromFormat('H:i:s', '09:12:15'),
                'end_time' => Carbon::createFromFormat('H:i:s', '12:40:12'),
                'patient_limit' => '20',
                'organization_id' => 2,
                'doctor_id' => 4,
            ],
            [
                'week_day' => 'Monday',
                'start_time' => Carbon::createFromFormat('H:i:s', '09:12:15'),
                'end_time' => Carbon::createFromFormat('H:i:s', '12:40:12'),
                'patient_limit' => '20',
                'organization_id' => 3,
                'doctor_id' => 6,
            ],
            [
                'week_day' => 'Monday',
                'start_time' => Carbon::createFromFormat('H:i:s', '09:12:15'),
                'end_time' => Carbon::createFromFormat('H:i:s', '12:40:12'),
                'patient_limit' => '20',
                'organization_id' => 3,
                'doctor_id' => 7,
            ],
        ];

        foreach ($doctors_schedule as $schedule) {
            AllDoctorsSchedule::create($schedule);
        }
    }
}

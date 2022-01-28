<?php

use App\Models\Patient;
use App\Models\PatientAppointment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PatientAppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = [
            [
                'first_name' => 'Kaderul',
                'last_name' => 'Islam',
                'phone_number' => '01856298431',
                'gender' => 'male',
                'age' => 50,
                'dob' => Carbon::createFromFormat('Y-m-d', '1971-01-05'),
                'address' => 'Bashkhali, Chittagong',
                'status' => true,
                'blood_group_id' => '5',
                'religion' => 'Islam',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-07-04'),
                'start_time' => Carbon::createFromFormat('H:i:s','07:15:50'),
                'end_time' => Carbon::createFromFormat('H:i:s','07:26:50'),
                'doctor_id' => 5,
                'organization_id' => 1,
            ],
            [
                'first_name' => 'Saima',
                'last_name' => 'Begum',
                'phone_number' => '01820658601',
                'gender' => 'female',
                'age' => 40,
                'dob' => Carbon::createFromFormat('Y-m-d', '1980-02-25'),
                'address' => 'Farmgate, Dhaka',
                'status' => true,
                'blood_group_id' => '1',
                'religion' => 'Islam',
                'date' => Carbon::createFromFormat('Y-m-d', '2021-07-04'),
                'start_time' => Carbon::createFromFormat('H:i:s','09:15:50'),
                'end_time' => Carbon::createFromFormat('H:i:s','09:26:50'),
                'doctor_id' => 5,
                'organization_id' => 1,
            ],
//            [
//                'first_name' => 'Abirul',
//                'last_name' => 'Islam',
//                'phone_number' => '01825198036',
//                'gender' => 'male',
//                'age' => 10,
//                'dob' => Carbon::createFromFormat('Y-m-d', '1911-02-12'),
//                'address' => 'Tigerpass, Chittagong',
//                'status' => true,
//                'blood_group_id' => '3',
//                'date' => Carbon::createFromFormat('Y-m-d', '2021-07-11'),
//                'time' => Carbon::createFromFormat('H:i:s','09:10:50'),
//                'doctor_id' => 3,
//                'organization_id' => 2,
//            ],
//            [
//                'first_name' => 'Mokbul',
//                'last_name' => 'Uddin',
//                'phone_number' => '01852525215',
//                'gender' => 'male',
//                'age' => 24,
//                'dob' => Carbon::createFromFormat('Y-m-d', '1997-06-05'),
//                'address' => 'Abul Hotel, Dhaka',
//                'status' => true,
//                'blood_group_id' => '8',
//                'date' => Carbon::createFromFormat('Y-m-d', '2021-08-26'),
//                'time' => Carbon::createFromFormat('H:i:s','11:45:53'),
//                'doctor_id' => 7,
//                'organization_id' => 3,
//            ]
        ];
        foreach($patients as $patient) {
            $p = Patient::create([
                'first_name' => $patient['first_name'],
                'last_name' => $patient['last_name'],
                'phone_number' => $patient['phone_number'],
                'gender' => $patient['gender'],
                'age' => $patient['age'],
                'dob' => $patient['dob'],
                'address' => $patient['address'],
                'religion' => $patient['religion'],
                'status'=>$patient['status'],
                'blood_group_id'=>$patient['blood_group_id'],
                'organization_id' => $patient['organization_id'],
            ]);
            $appointment = PatientAppointment::create([
                'patient_id' => $p['id'],
                'organization_id' => $patient['organization_id'],
                'doctor_id' => $patient['doctor_id'],
                'date' => $patient['date'],
                'start_time' => $patient['start_time'],
                'end_time' => $patient['end_time'],
            ]);
        }
    }
}

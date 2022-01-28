<?php

use App\Models\DoctorAssignToPatient;
use App\Models\Patient;
use App\Models\PatientAdmitAndDischarge;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
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
                'first_name' => 'Zohirul',
                'last_name' => 'Islam',
                'phone_number' => '01823598431',
                'gender' => 'male',
                'age' => 50,
                'dob' => Carbon::createFromFormat('Y-m-d', '1971-01-05'),
                'address' => 'Andorkilla, Chittagong',
                'religion' => 'Islam',
                'status' => true,
                'is_alive' => true,
                'blood_group_id' => '5',
                'attendee_name' => 'Kabirul Islam',
                'attendee_relation_with_patient' => 'Son',
                'admit_date' => Carbon::createFromFormat('Y-m-d', '2021-04-05'),
                'admit_time' => Carbon::createFromFormat('H:i:s','12:36:10'),
                'doctor_type_for_patient' => 'root',
                'doctor_id' => 1,
                'organization_id' => 1,
            ],
            [
                'first_name' => 'Khadija',
                'last_name' => 'Begum',
                'phone_number' => '01850648601',
                'gender' => 'female',
                'age' => 40,
                'dob' => Carbon::createFromFormat('Y-m-d', '1980-02-25'),
                'address' => 'Khilgaon, Dhaka',
                'religion' => 'Islam',
                'status' => true,
                'is_alive' => true,
                'blood_group_id' => '1',
                'attendee_name' => 'Bilkis Begum',
                'attendee_relation_with_patient' => 'Daughter',
                'admit_date' => Carbon::createFromFormat('Y-m-d', '2020-10-18'),
                'admit_time' => Carbon::createFromFormat('H:i:s','12:52:12'),
                'doctor_type_for_patient' => 'reffered',
                'doctor_id' => 2,
                'organization_id' => 1,
            ],
            [
                'first_name' => 'Mominul',
                'last_name' => 'Islam',
                'phone_number' => '01820364036',
                'gender' => 'male',
                'age' => 10,
                'dob' => Carbon::createFromFormat('Y-m-d', '1911-02-12'),
                'address' => 'Bohddarhut, Chittagong',
                'religion' => 'Islam',
                'status' => true,
                'is_alive' => true,
                'blood_group_id' => '3',
                'attendee_name' => 'Abdul Islam',
                'attendee_relation_with_patient' => 'Father',
                'admit_date' => Carbon::createFromFormat('Y-m-d', '2021-03-11'),
                'admit_time' => Carbon::createFromFormat('H:i:s','10:42:25'),
                'doctor_type_for_patient' => 'root',
                'doctor_id' => 2,
                'organization_id' => 2,
            ],
            [
                'first_name' => 'Khairul',
                'last_name' => 'Islam',
                'phone_number' => '01815151515',
                'gender' => 'male',
                'age' => 24,
                'dob' => Carbon::createFromFormat('Y-m-d', '1997-06-05'),
                'address' => 'Malibag, Dhaka',
                'religion' => 'Islam',
                'status' => true,
                'is_alive' => true,
                'blood_group_id' => '8',
                'attendee_name' => 'Shairul Islam',
                'attendee_relation_with_patient' => 'Brother',
                'admit_date' => Carbon::createFromFormat('Y-m-d', '2021-02-19'),
                'admit_time' => Carbon::createFromFormat('H:i:s','07:47:50'),
                'doctor_type_for_patient' => 'consultant',
                'doctor_id' => 1,
                'organization_id' => 3,
            ]
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
                'is_alive'=>$patient['is_alive'],
                'blood_group_id'=>$patient['blood_group_id'],
                'organization_id' => $patient['organization_id'],
            ]);

            $p_admit = PatientAdmitAndDischarge::create([
                'patient_id' => $p['id'], // or $p->id
                'attendee_name' =>$patient['attendee_name'],
                'attendee_relation_with_patient' => $patient['attendee_relation_with_patient'],
                'admit_date' =>$patient['admit_date'],
                'admit_time' =>$patient['admit_time']
            ]);

            $p_assign = DoctorAssignToPatient::create([
                'patient_id' => $p['id'],
                'doctor_id' => $patient['doctor_id'],
                'assign_date'=>$patient['admit_date'],
//                'release_date'=>$patient['release_date'],
                'doctor_type_for_patient' => $patient['doctor_type_for_patient'],
            ]);
        }
    }
}

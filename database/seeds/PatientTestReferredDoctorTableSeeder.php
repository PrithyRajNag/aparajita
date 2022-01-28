<?php

use App\Models\PatientTestReferredDoctor;
use Illuminate\Database\Seeder;

class PatientTestReferredDoctorTableSeeder extends Seeder
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
                "name" => "Nafiz Uddin",
                "institution_name" => "National Hospital",
                "phone_number" => "01823659742",
                "degree" => "MBBS",
                "organization_id" => "1",
            ],
            [
                "name" => "Abul Kalam",
                "institution_name" => "Memorial Hospital",
                "phone_number" => "01629853145",
                "degree" => "MBBS",
                "organization_id" => "1",
            ],
            [
                "name" => "Shobuj Chowdhury",
                "institution_name" => "National Abul Hospital",
                "phone_number" => "01823659742",
                "degree" => "MBBS",
                "organization_id" => "1",
            ],
        ];
        foreach ($datas as $data){
            PatientTestReferredDoctor::create($data);
        }
    }
}

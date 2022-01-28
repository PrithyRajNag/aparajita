<?php


use App\Models\Ambulance;
use Illuminate\Database\Seeder;

class AmbulanceTableSeeder extends Seeder
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
                "vehicle_number" => 'M10N10',
                "vehicle_model"=>'Ambulance',
                'driver_name' => 'Mr. Anis',
                'driver_license' => '1593575648',
                'driver_phone_number' => '01684567891',
                'driver_address' => 'Badda',
                'organization_id'=>'1'
            ],
            [
                "vehicle_number" => 'M11N11',
                "vehicle_model"=>'Ambulance',
                'driver_name' => 'Mr. Karim',
                'driver_license' => '1593574123',
                'driver_phone_number' => '01684000000',
                'driver_address' => 'Tejgaon',
                'organization_id'=>'3'
            ],
            [
                "vehicle_number" => 'M12N12',
                "vehicle_model"=>'Ambulance',
                'driver_name' => 'Mr. Rahim',
                'driver_license' => '1593574789',
                'driver_phone_number' => '01684111111',
                'driver_address' => 'Nikunjo',
                'organization_id'=>'2'
            ],
            [
                "vehicle_number" => 'M13N13',
                "vehicle_model"=>'Ambulance',
                'driver_name' => 'Mr. Kuddus',
                'driver_license' => '1593578426',
                'driver_phone_number' => '01684222222',
                'driver_address' => 'Rampura',
                'organization_id'=>'1'
            ]
        ];
        foreach ($datas as $data){
            Ambulance::create($data);
        }
    }
}

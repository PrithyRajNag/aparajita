<?php

use App\Models\CompanyModule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyModule::truncate();

        $datas=[
            [
                //id=1
                "name" => 'Doctor',
                "note" => 'Doctor Module',
                "is_mandatory" => true,
                "status" => 1,
            ],
            [
                //id=2
                "name" => 'Staff',
                "note" => 'Staff Module',
                "is_mandatory" => true,
                "status" => 1,
            ],
            [
                //id=3
                "name" => 'Patient',
                "note" => 'Patient Module',
                "is_mandatory" => true,
                "status" => 1,
            ],
            [
                //id=4
                "name" => 'Department',
                "note" => 'Department Module',
                "is_mandatory" => true,
                "status" => 1,
            ],
            [
                //id=5
                "name" => 'Notice',
                "note" => 'Notice Module',
                "is_mandatory" => true,
                "status" => 1,
            ],
            [
                //id=6
                "name" => 'Setting',
                "note" => 'Setting Module',
                "is_mandatory" => true,
                "status" => 1,
            ],
            [
                //id=7
                "name" => 'Account',
                "note" => 'Account Module',
                "is_mandatory" => true,
                "status" => 1,
            ],
            [
                //id=8
                "name" => 'Blood',
                "note" => 'Blood Module',
                "is_mandatory" => false,
                "status" => 1,
            ],
            [
                //id=9
                "name" => 'Bed',
                "note" => 'Bed Module',
                "is_mandatory" => false,
                "status" => 1,
            ],

            [
                //id=10
                "name" => 'Birth',
                "note" => 'Birth Module',
                "is_mandatory" => false,
                "status" => 1,
            ],
            [
                //id=11
                "name" => 'Death',
                "note" => 'Death Module',
                "is_mandatory" => false,
                "status" => 1,
            ],
            [
                //id=12
                "name" => 'Test',
                "note" => 'Test Module',
                "is_mandatory" => false,
                "status" => 1,
            ],
            [
                //id=13
                "name" => 'Ambulance',
                "note" => 'Ambulance Module',
                "is_mandatory" => false,
                "status" => 1,
            ],
            [
                //id=14
                "name" => 'Health-Card',
                "note" => 'Health-Card Module',
                "is_mandatory" => false,
                "status" => 1,
            ],
            [
                //id=15
                "name" => 'Email',
                "note" => 'Email Module',
                "is_mandatory" => false,
                "status" => 1,
            ],
            [
                //id=16
                "name" => 'Sms',
                "note" => 'Sms Module',
                "is_mandatory" => false,
                "status" => 1,
            ],
        ];
        foreach ($datas as $data){
            CompanyModule::create($data);
        }
    }
}

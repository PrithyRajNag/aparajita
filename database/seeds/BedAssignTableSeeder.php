<?php

use App\Models\BedAssign;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BedAssignTableSeeder extends Seeder
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
//                'bed_number' => 'C14',
//                'floor' => '3rd',
//                'price' => 1200,
//                'description' => '3rd Floor Bed',
                'start_date'=> Carbon::createFromFormat('Y-m-d', '2021-05-15'),
                'end_date'=>Carbon::createFromFormat('Y-m-d', '2021-05-27'),
                'status' => true,
                'organization_id' => '1',
//                'bed_type_id' => '1',
                'bed_list_id' => '3',
                'patient_id' => '2'
            ],
            [
//                'bed_number' => 'B17',
//                'floor' => '2nd',
//                'price' => 1000,
//                'description' => '2nd Floor Bed',
                'start_date'=> Carbon::createFromFormat('Y-m-d', '2021-06-13'),
                'end_date'=>Carbon::createFromFormat('Y-m-d', '2021-06-22'),
                'status' => true,
                'organization_id' => '1',
//                'bed_type_id' => '2',
                'bed_list_id' => '2',
                'patient_id' => '3'
            ],
            [
//                'bed_number' => 'A15',
//                'floor' => '1st',
//                'price' => 1100,
//                'description' => '1st Floor Bed',
                'start_date'=> Carbon::createFromFormat('Y-m-d', '2021-02-10'),
                'end_date'=>Carbon::createFromFormat('Y-m-d', '2021-02-12'),
                'status' => true,
                'organization_id' => '2',
//                'bed_type_id' => '2',
                'bed_list_id' => '2',
                'patient_id' => '2'
            ]
        ];
//        foreach ($datas as $data){
//            BedAssign::create($data);
//        }
    }
}

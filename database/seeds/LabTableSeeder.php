<?php

use App\Models\Lab;
use Illuminate\Database\Seeder;

class LabTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'name' => 'Apolo 1',
                'address' => 'East Badda',
                'status' => true,
                'organization_id' => '1',
            ],
            [
                'name' => 'Apolo 2',
                'address' => 'West Badda',
                'status' => true,
                'organization_id' => '1',
            ],
            [
                'name' => 'Apolo 3',
                'address' => 'North Badda',
                'status' => true,
                'organization_id' => '1',
            ],
        ];

        foreach ($datas as $data) {
            Lab::create($data);
        }
    }

}

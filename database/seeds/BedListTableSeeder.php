<?php

use App\Models\BedList;
use Illuminate\Database\Seeder;

class BedListTableSeeder extends Seeder
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
                'bed_number' => 'C14',
                'floor' => '3rd',
                'price' => 1200,
                'description' => '3rd Floor Bed',
                'is_available' => true,
                'status' => true,
                'organization_id' => '1',
                'bed_type_id' => '1'
            ],
            [
                'bed_number' => 'C15',
                'floor' => '3rd',
                'price' => 1100,
                'description' => '3rd Floor Bed',
                'is_available' => true,
                'status' => true,
                'organization_id' => '1',
                'bed_type_id' => '1'
            ],
            [
                'bed_number' => 'C16',
                'floor' => '3rd',
                'price' => 1250,
                'description' => '3rd Floor Bed',
                'is_available' => true,
                'status' => true,
                'organization_id' => '1',
                'bed_type_id' => '1'
            ],
            [
                'bed_number' => 'C17',
                'floor' => '3rd',
                'price' => 1400,
                'description' => '3rd Floor Bed',
                'is_available' => true,
                'status' => true,
                'organization_id' => '1',
                'bed_type_id' => '1'
            ],
            [
                'bed_number' => 'C18',
                'floor' => '3rd',
                'price' => 1000,
                'description' => '3rd Floor Bed',
                'is_available' => true,
                'status' => true,
                'organization_id' => '1',
                'bed_type_id' => '1'
            ],
            [
                'bed_number' => 'B14',
                'floor' => '2nd',
                'price' => 1300,
                'description' => '2nd Floor Bed',
                'is_available' => true,
                'status' => true,
                'organization_id' => '2',
                'bed_type_id' => '2'
            ],
            [
                'bed_number' => 'C19',
                'floor' => '3rd',
                'price' => 1500,
                'description' => '3rd Floor Bed',
                'is_available' => true,
                'status' => true,
                'organization_id' => '1',
                'bed_type_id' => '2'
            ],
            [
                'bed_number' => 'A12',
                'floor' => '1st',
                'price' => 1000,
                'description' => '1st Floor Bed',
                'is_available' => true,
                'status' => true,
                'organization_id' => '2',
                'bed_type_id' => '1'
            ],

        ];

        foreach ($datas as $data) {
            BedList::create($data);
        }
    }
}

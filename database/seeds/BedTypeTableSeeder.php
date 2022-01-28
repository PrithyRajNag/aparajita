<?php

use App\Models\BedType;
use Illuminate\Database\Seeder;

class BedTypeTableSeeder extends Seeder
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
                'name' => 'Normal',
                'description' => 'Bed for general rooms',
                'status' => true,
                'organization_id' => '1'
            ],
            [
                'name' => 'Private',
                'description' => 'Bed for private rooms',
                'status' => true,
                'organization_id' => '1'
            ],
            [
                'name' => 'Remote Control',
                'description' => 'Bed for ICU,CCU etc.',
                'status' => true,
                'organization_id' => '1'
            ],

        ];

        foreach ($datas as $data) {
            BedType::create($data);
        }
    }
}

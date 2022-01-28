<?php

use App\Models\TestCategory;
use Illuminate\Database\Seeder;

class TestCategoriesTableSeeder extends Seeder
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
                'name' => 'Blood Test',
                'description' => 'Blood Related Test',
                'status' => true,
                'lab_id' => '1',
                'organization_id' => '1',
            ],
            [
                'name' => 'Urine Test',
                'description' => null,
                'status' => true,
                'lab_id' => '2',
                'organization_id' => '1',
            ],
            [
                'name' => 'Liver Test',
                'description' => 'Liver Related Test',
                'status' => true,
                'lab_id' => '3',
                'organization_id' => '1',
            ],
            [
                'name' => 'Ultrasonography',
                'description' => null,
                'status' => true,
                'lab_id' => '3',
                'organization_id' => '1',
            ],
            [
                'name' => 'Blood Test',
                'description' => 'Blood Related Test',
                'status' => true,
                'lab_id' => '1',
                'organization_id' => '2',
            ],
            [
                'name' => 'Urine Test',
                'description' => null,
                'status' => true,
                'lab_id' => '2',
                'organization_id' => '2',
            ],
            [
                'name' => 'Blood Test',
                'description' => 'Blood Related Test',
                'status' => true,
                'lab_id' => '1',
                'organization_id' => '3',
            ],
            [
                'name' => 'Urine Test',
                'description' => null,
                'status' => true,
                'lab_id' => '2',
                'organization_id' => '3',
            ],
            [
                'name' => 'Liver Test',
                'description' => 'Liver Related Test',
                'status' => true,
                'lab_id' => '3',
                'organization_id' => '3',
            ],
            [
                'name' => 'Ultrasonography',
                'description' => null,
                'status' => true,
                'lab_id' => '3',
                'organization_id' => '3',
            ],
        ];

        foreach ($datas as $data) {
            TestCategory::create($data);
        }
    }
}

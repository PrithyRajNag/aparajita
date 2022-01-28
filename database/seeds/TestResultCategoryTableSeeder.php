<?php

use App\Models\TestResultCategory;
use Illuminate\Database\Seeder;

class TestResultCategoryTableSeeder extends Seeder
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
                'name' => 'Hematological Report',
                'description' => 'CBC Related Report',
                'status' => true,
                'test_item_id' => '1',
                'organization_id' => '1',
            ],
            [
                'name' => 'Total Count',
                'description' => 'CBC Related Report',
                'status' => true,
                'test_item_id' => '1',
                'organization_id' => '1',
            ],
            [
                'name' => 'Differential Count',
                'description' => 'CBC Related Report',
                'status' => true,
                'test_item_id' => '1',
                'organization_id' => '1',
            ],
            [
                'name' => 'Physical Examination (CHM)',
                'description' => 'Urine Related Report',
                'status' => true,
                'test_item_id' => '4',
                'organization_id' => '1',
            ],
            [
                'name' => 'Chemical Examination (CHM)',
                'description' => 'Urine Related Report',
                'status' => true,
                'test_item_id' => '4',
                'organization_id' => '1',
            ],




            [
                'name' => 'Hematological Report',
                'description' => 'CBC Related Report',
                'status' => true,
                'test_item_id' => '1',
                'organization_id' => '2',
            ],
            [
                'name' => 'Total Count',
                'description' => 'CBC Related Report',
                'status' => true,
                'test_item_id' => '1',
                'organization_id' => '2',
            ],
            [
                'name' => 'Differential Count',
                'description' => 'CBC Related Report',
                'status' => true,
                'test_item_id' => '1',
                'organization_id' => '2',
            ],
            [
                'name' => 'Physical Examination (CHM)',
                'description' => 'Urine Related Report',
                'status' => true,
                'test_item_id' => '4',
                'organization_id' => '2',
            ],
            [
                'name' => 'Chemical Examination (CHM)',
                'description' => 'Urine Related Report',
                'status' => true,
                'test_item_id' => '4',
                'organization_id' => '2',
            ],

        ];

        foreach ($datas as $data) {
            TestResultCategory::create($data);
        }
    }
}

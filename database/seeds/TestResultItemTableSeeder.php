<?php

use App\Models\TestResultItem;
use Illuminate\Database\Seeder;

class TestResultItemTableSeeder extends Seeder
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
                'name' => 'Haemoglobin(Hb%)',
                'normal_range' => 'M:13-18, F:11.5-16.5',
                'unit' => 'gm/dl',
                'status' => true,
                'test_result_category_id' => '1',
                'organization_id' => '1',
            ],
            [
                'name' => 'E.S.R',
                'normal_range' => 'M:0-10, F:0-20',
                'unit' => 'mm in 1st Hour',
                'status' => true,
                'test_result_category_id' => '1',
                'organization_id' => '1',
            ],
            [
                'name' => 'Haematocrit',
                'normal_range' => 'M-40-54, F-37-47%',
                'unit' => '%',
                'status' => true,
                'test_result_category_id' => '1',
                'organization_id' => '1',
            ],
            [
                'name' => 'Total Red Blood Cells',
                'normal_range' => 'M:4.5-6.5, F:3.8-5.8',
                'unit' => 'million/cmm',
                'status' => true,
                'test_result_category_id' => '2',
                'organization_id' => '1',
            ],
            [
                'name' => 'Total White Blood Cells',
                'normal_range' => '4000-11000',
                'unit' => '/cmm',
                'status' => true,
                'test_result_category_id' => '2',
                'organization_id' => '1',
            ],


            [
                'name' => 'Haemoglobin(Hb%)',
                'normal_range' => 'M:13-18, F:11.5-16.5',
                'unit' => 'gm/dl',
                'status' => true,
                'test_result_category_id' => '1',
                'organization_id' => '2',
            ],
            [
                'name' => 'E.S.R',
                'normal_range' => 'M:0-10, F:0-20',
                'unit' => 'mm in 1st Hour',
                'status' => true,
                'test_result_category_id' => '1',
                'organization_id' => '2',
            ],
            [
                'name' => 'Haematocrit',
                'normal_range' => 'M-40-54, F-37-47%',
                'unit' => '%',
                'status' => true,
                'test_result_category_id' => '1',
                'organization_id' => '2',
            ],
            [
                'name' => 'Total Red Blood Cells',
                'normal_range' => 'M:4.5-6.5, F:3.8-5.8',
                'unit' => 'million/cmm',
                'status' => true,
                'test_result_category_id' => '2',
                'organization_id' => '2',
            ],
            [
                'name' => 'Total White Blood Cells',
                'normal_range' => '4000-11000',
                'unit' => '/cmm',
                'status' => true,
                'test_result_category_id' => '2',
                'organization_id' => '2',
            ],

        ];

        foreach ($datas as $data) {
            TestResultItem::create($data);
        }
    }
}

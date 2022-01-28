<?php

use App\Models\TestItem;
use Illuminate\Database\Seeder;

class TestItemsTableSeeder extends Seeder
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
                'name' => 'CBC',
                'description' => 'Blood Related Test',
                'price' => 1000,
                'status' => true,
                'test_category_id' => '1',
                'organization_id' => '1',
            ],
            [
                'name' => 'ESR',
                'description' => 'Blood Related Test',
                'price' => 1200,
                'status' => true,
                'test_category_id' => '1',
                'organization_id' => '1',
            ],
            [
                'name' => 'Blood Film',
                'description' => 'Blood Related Test',
                'price' => 2500,
                'status' => true,
                'test_category_id' => '1',
                'organization_id' => '1',
            ],
            [
                'name' => 'Urine R/E',
                'description' => 'Urine Related Test',
                'price' => 800,
                'status' => true,
                'test_category_id' => '2',
                'organization_id' => '1',
            ],
            [
                'name' => 'Urine C/S',
                'description' => 'Urine Related Test',
                'price' => 900,
                'status' => true,
                'test_category_id' => '2',
                'organization_id' => '1',
            ],



            [
                'name' => 'CBC',
                'description' => 'Blood Related Test',
                'price' => 1000,
                'status' => true,
                'test_category_id' => '1',
                'organization_id' => '2',
            ],
            [
                'name' => 'ESR',
                'description' => 'Blood Related Test',
                'price' => 1200,
                'status' => true,
                'test_category_id' => '1',
                'organization_id' => '2',
            ],
            [
                'name' => 'Blood Film',
                'description' => 'Blood Related Test',
                'price' => 2500,
                'status' => true,
                'test_category_id' => '1',
                'organization_id' => '2',
            ],
            [
                'name' => 'Urine R/E',
                'description' => 'Urine Related Test',
                'price' => 800,
                'status' => true,
                'test_category_id' => '2',
                'organization_id' => '2',
            ],
        ];

        foreach ($datas as $data) {
            TestItem::create($data);
        }
    }
}

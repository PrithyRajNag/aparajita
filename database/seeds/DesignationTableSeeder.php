<?php

use App\Models\CompanyDesignation;
use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['name' => 'Owner'],
            ['name' => 'CEO'],
            ['name' => 'Developer'],
            ['name' => 'Marketing'],
            ['name' => 'Service'],
        ];

        foreach ($datas as $data) {
            CompanyDesignation::create($data);
        }
    }
}

<?php

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments=[
            [
                "name" => 'Surgery',
                "description"=>'Surgery Unit',
                'organization_id' => 1
            ],
            [
                "name" => 'Medicine',
                "description"=>'Medicine Unit',
                'organization_id' => 1
            ],
            [
                "name" => 'Baby Care',
                "description"=>'Baby Care Unit',
                'organization_id' => 1
            ],
            [
                "name" => 'Heart',
                "description"=>'Heart Unit',
                'organization_id' => 1
            ],
            [
                "name" => 'Eye',
                "description"=>'Eye Unit',
                'organization_id' => 1
            ],
            [
                "name" => 'Burn',
                "description"=>'Burn Unit',
                'organization_id' => 1
            ]
        ];
        foreach ($departments as $department){
            Department::create($department);
        }
    }
}


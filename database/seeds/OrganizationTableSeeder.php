<?php

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = [
            [
                "name" => 'Sher-E-Bangla organization',
                "address" => 'Sher-E-Bangla organization Address',
                'organization_type' => 'clinic',
                'is_one_time_purchase' => true,
            ],
            [
                "name" => 'Bangobondhu Memorial organization',
                "address" => 'Bangobondhu Memorial organization Address',
                'organization_type' => 'diagnostic',
                'is_one_time_purchase' => false,
                "monthly_bill" => 2700,
            ],
            [
                "name" => 'Dhaka Medical College',
                "address" => 'Dhaka Medical College Address',
                'organization_type' => 'hospital',
                'is_one_time_purchase' => false,
                "monthly_bill" => 2900,
            ],
        ];
        foreach ($organizations as $organization) {
            Organization::create($organization);
        }
    }
}

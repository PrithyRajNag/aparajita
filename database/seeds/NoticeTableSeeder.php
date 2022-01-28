<?php

use App\Models\Notice;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class NoticeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notices=[
            [
                "title" => 'Notice 1',
                "description" => 'Notice number one',
                "start_date" => Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                "end_date" => Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                "status" => true,
                "organization_id" => '2',
                "role_id" => '2'
            ],
            [
                "title"=>'Notice 2',
                "description"=>'Notice number two',
                "start_date"=> Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                "end_date"=> Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                "status"=>true,
                "organization_id"=>'2',
                "role_id"=>'3'
            ],
            [
                "title"=>'Notice 3',
                "description"=>'Notice number three',
                "start_date"=> Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                "end_date"=> Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                "status"=>true,
                "organization_id"=>'2',
                "role_id"=>'2'
            ],
            [
                "title"=>'Notice 4',
                "description"=>'Notice number four',
                "start_date"=> Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                "end_date"=>Carbon::createFromFormat('Y-m-d', '2021-01-01'),
                "status"=>true,
                "organization_id"=>'1',
                "role_id"=>'4'
            ]
        ];
        foreach ($notices as $notice){
            Notice::create($notice);
        }
    }
}

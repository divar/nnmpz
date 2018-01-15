<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('sizes')->delete();

        $data = [
            ['id'=>1,'nama'=>'S','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>2,'nama'=>'R','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>3,'nama'=>'L','created_at'=>date('Y-m-d H:i:s')],
        ];

        \DB::table('sizes')->insert($data);
    }
}

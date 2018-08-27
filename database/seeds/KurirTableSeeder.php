<?php

use Illuminate\Database\Seeder;

class KurirTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kurir')->delete();

        $data = [
            ['id'=>1,'nama'=>'Go Food','persen'=>'15','created_at'=>date('Y-1-1 H:i:s')],
            
        ];

        \DB::table('kurir')->insert($data);
    }
}

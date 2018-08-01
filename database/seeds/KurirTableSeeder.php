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
            ['id'=>1,'nama'=>'Grab','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>2,'nama'=>'Gojek','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>3,'nama'=>'Uber','created_at'=>date('Y-m-d H:i:s')],
        ];

        \DB::table('kurir')->insert($data);
    }
}

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
            ['id'=>1,'nama'=>'Grab','persen'=>'12','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>2,'nama'=>'Gojek','persen'=>'20','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>3,'nama'=>'Uber','persen'=>'60','created_at'=>date('Y-1-1 H:i:s')],
        ];

        \DB::table('kurir')->insert($data);
    }
}

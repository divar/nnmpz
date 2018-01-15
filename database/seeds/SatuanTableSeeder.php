<?php

use Illuminate\Database\Seeder;

class SatuanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('satuans')->delete();

        $data = [
            ['id'=>1,'satuan'=>'Box','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>2,'satuan'=>'Botol','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>3,'satuan'=>'Tupper Ware','created_at'=>date('Y-m-d H:i:s')],
        ];

        \DB::table('satuans')->insert($data);
    }
}

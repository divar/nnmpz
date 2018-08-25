<?php

use Illuminate\Database\Seeder;

class TarifWilayahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tarif_wilayahs')->delete();

        $data = [
            ['id'=>1,'nama'=>'Area 1','harga'=>'10000','keterangan'=>'P1','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>2,'nama'=>'Area 2','harga'=>'20000','keterangan'=>'P2','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>3,'nama'=>'Area 3','harga'=>'30000','keterangan'=>'P3','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>4,'nama'=>'Area 4','harga'=>'15000','keterangan'=>'P4','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>5,'nama'=>'Area 5','harga'=>'20000','keterangan'=>'P5','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>6,'nama'=>'Area 6','harga'=>'25000','keterangan'=>'P6','created_at'=>date('Y-m-d H:i:s')],
        ];

        \DB::table('tarif_wilayahs')->insert($data);
    }
}

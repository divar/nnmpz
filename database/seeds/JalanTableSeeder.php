<?php

use Illuminate\Database\Seeder;

class JalanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jalans')->delete();

        $data = [
            ['id'=>1,'id_tarif_wilayah'=>1,'nama'=>'Area 1 Moses','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>2,'id_tarif_wilayah'=>2,'nama'=>'Area 2 Moses','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>3,'id_tarif_wilayah'=>3,'nama'=>'Area 3 Moses','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>4,'id_tarif_wilayah'=>4,'nama'=>'Area 4 Moses','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>5,'id_tarif_wilayah'=>5,'nama'=>'Area 5 Moses','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>6,'id_tarif_wilayah'=>6,'nama'=>'Area 6 Moses','created_at'=>date('Y-1-1 H:i:s')],
        ];

        \DB::table('jalans')->insert($data);

        DB::table('jenis')->delete();

        $data = [
            ['id'=>1,'id_tarif_wilayah'=>1,'jenis'=>'35 Homestay','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>2,'id_tarif_wilayah'=>2,'jenis'=>'Kos Kosan Gayam','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>3,'id_tarif_wilayah'=>3,'jenis'=>'Resort','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>4,'id_tarif_wilayah'=>4,'jenis'=>'Kantor','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>5,'id_tarif_wilayah'=>5,'jenis'=>'Gedung Serba Guna','created_at'=>date('Y-1-1 H:i:s')],
        ];

        \DB::table('jenis')->insert($data);
    }
}

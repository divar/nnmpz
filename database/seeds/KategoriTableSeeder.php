<?php

use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_makanan')->delete();

        $data_jenis_makanan = [
            ['id'=>1,'nama'=>'Food'],
            ['id'=>2,'nama'=>'Beverage'],
        ];

        \DB::table('jenis_makanan')->insert($data_jenis_makanan);

        DB::table('kategoris')->delete();

        $data = [
            ['id'=>1,'id_satuan'=>'1','nama'=>'Milkshake','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>2,'id_satuan'=>'1','nama'=>'Lassy	','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>3,'id_satuan'=>'1','nama'=>'Smoothie','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>4,'id_satuan'=>'1','nama'=>'Special Drink','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>5,'id_satuan'=>'1','nama'=>'Fresh Juice','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>6,'id_satuan'=>'1','nama'=>'Antipasti','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>7,'id_satuan'=>'1','nama'=>'Zuppe','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>8,'id_satuan'=>'1','nama'=>'Insalata','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>9,'id_satuan'=>'1','nama'=>'Panini','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>10,'id_satuan'=>'1','nama'=>'Primi Piatti','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>11,'id_satuan'=>'1','nama'=>'Secondi','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>12,'id_satuan'=>'1','nama'=>'Soft Drink','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>13,'id_satuan'=>'1','nama'=>'Caffetteria','flag_addon'=>'N','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>14,'id_satuan'=>'1','nama'=>'DRESSING','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>15,'id_satuan'=>'1','nama'=>'VEGETABLE','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>16,'id_satuan'=>'1','nama'=>'MEAT','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'1'],
            ['id'=>17,'id_satuan'=>'1','nama'=>'SEAFOOD','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'2'],
            ['id'=>18,'id_satuan'=>'1','nama'=>'CHEESE','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'2'],
            ['id'=>19,'id_satuan'=>'1','nama'=>'SAUCE','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'2'],
            ['id'=>20,'id_satuan'=>'1','nama'=>'FRUIT','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'2'],
            ['id'=>21,'id_satuan'=>'1','nama'=>'DOLCI','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'2'],
            ['id'=>22,'id_satuan'=>'1','nama'=>'DRINK','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'2'],
            ['id'=>23,'id_satuan'=>'1','nama'=>'LAIN-LAIN','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s'),'id_jenis_makanan'=>'2'],
        ];

        \DB::table('kategoris')->insert($data);
    }
}

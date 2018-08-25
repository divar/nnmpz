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

        $data =  [
          ['id' => '1','nama' => 'Milkshake','flag_addon' => 'N','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '2','nama' => 'Lassy','flag_addon' => 'N','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '3','nama' => 'Smoothie','flag_addon' => 'N','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '4','nama' => 'Special Drink','flag_addon' => 'N','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '5','nama' => 'Fresh Juice','flag_addon' => 'N','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '6','nama' => 'Antipasti','flag_addon' => 'N','id_satuan' => '4','id_jenis_makanan' => '1','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '7','nama' => 'Zuppe','flag_addon' => 'N','id_satuan' => '3','id_jenis_makanan' => '1','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '8','nama' => 'Insalata','flag_addon' => 'N','id_satuan' => '4','id_jenis_makanan' => '1','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '9','nama' => 'Panini','flag_addon' => 'N','id_satuan' => '4','id_jenis_makanan' => '1','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '10','nama' => 'Primi Piatti','flag_addon' => 'N','id_satuan' => '4','id_jenis_makanan' => '1','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '11','nama' => 'Secondi','flag_addon' => 'N','id_satuan' => '4','id_jenis_makanan' => '1','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '12','nama' => 'Soft Drink','flag_addon' => 'N','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '13','nama' => 'Caffetteria','flag_addon' => 'N','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '14','nama' => 'DRESSING','flag_addon' => 'Y','id_satuan' => '1','id_jenis_makanan' => '1','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '15','nama' => 'VEGETABLE','flag_addon' => 'Y','id_satuan' => '1','id_jenis_makanan' => '1','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '16','nama' => 'MEAT','flag_addon' => 'Y','id_satuan' => '1','id_jenis_makanan' => '1','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '17','nama' => 'SEAFOOD','flag_addon' => 'Y','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '18','nama' => 'CHEESE','flag_addon' => 'Y','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '19','nama' => 'SAUCE','flag_addon' => 'Y','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '20','nama' => 'FRUIT','flag_addon' => 'Y','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '21','nama' => 'DOLCI','flag_addon' => 'Y','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '22','nama' => 'DRINK','flag_addon' => 'Y','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '23','nama' => 'LAIN-LAIN','flag_addon' => 'Y','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-23 02:46:59'],
          ['id' => '24','nama' => 'Pizza','flag_addon' => 'N','id_satuan' => '5','id_jenis_makanan' => '1','trash' => NULL,'created_at' => '2018-08-26 05:27:48'],
          ['id' => '25','nama' => 'Soft Drink','flag_addon' => 'N','id_satuan' => '1','id_jenis_makanan' => '2','trash' => NULL,'created_at' => '2018-08-26 06:06:46'],
          ['id' => '26','nama' => 'Dolci','flag_addon' => 'N','id_satuan' => '1','id_jenis_makanan' => NULL,'trash' => NULL,'created_at' => '2018-08-25 08:18:08']
        ];

        \DB::table('kategoris')->insert($data);
    }
}

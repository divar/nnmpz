<?php

use Illuminate\Database\Seeder;

class AddOnTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('add_on_menus')->delete();

        $data = [
            ['id'=>1,'id_kategori'=>'15','nama'=>'Saos Tiram','keterangan'=>'sayuran dengan tambahan saus di atasnya','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>1,'id_kategori'=>'15','nama'=>'Saos Ikan','keterangan'=>'sayuran dengan tambahan saus di atasnya','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>1,'id_kategori'=>'16','nama'=>'Saos Kepiting','keterangan'=>'sayuran dengan tambahan saus di atasnya','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>1,'id_kategori'=>'16','nama'=>'Saos Ikan asin','keterangan'=>'sayuran dengan tambahan saus di atasnya','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>1,'id_kategori'=>'16','nama'=>'Saos Udang','keterangan'=>'sayuran dengan tambahan saus di atasnya','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>1,'id_kategori'=>'17','nama'=>'Saos aZaa','keterangan'=>'sayuran dengan tambahan saus di atasnya','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>1,'id_kategori'=>'17','nama'=>'Saos Ikan Teri','keterangan'=>'sayuran dengan tambahan saus di atasnya','created_at'=>date('Y-m-d H:i:s')],
        ];

        \DB::table('add_on_menus')->insert($data);
    }
}

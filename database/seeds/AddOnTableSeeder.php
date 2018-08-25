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

            ['id'=>1,'id_kategori'=>'14','nama'=>'Ittalian Dressing','harga'=>'5000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>2,'id_kategori'=>'14','nama'=>'Mayo','harga'=>'5000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],            
            ['id'=>3,'id_kategori'=>'14','nama'=>'Balsamic Dressing','harga'=>'5000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>4,'id_kategori'=>'14','nama'=>'Balsamic','harga'=>'5000','keterangan'=>'Tampilan seperti ala itali','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>5,'id_kategori'=>'15','nama'=>'Onion','harga'=>'4000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>6,'id_kategori'=>'15','nama'=>'Garlic','harga'=>'4000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>7,'id_kategori'=>'15','nama'=>'Basil','harga'=>'4000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>8,'id_kategori'=>'15','nama'=>'Parsley','harga'=>'4000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>9,'id_kategori'=>'15','nama'=>'Cabe','harga'=>'5000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>10,'id_kategori'=>'15','nama'=>'Cashew Nut','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>11,'id_kategori'=>'15','nama'=>'Mushroom','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>12,'id_kategori'=>'15','nama'=>'Brokoli','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>13,'id_kategori'=>'15','nama'=>'Paprika','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>14,'id_kategori'=>'15','nama'=>'Spinach','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>15,'id_kategori'=>'15','nama'=>'Tomato','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>16,'id_kategori'=>'15','nama'=>'Black Olive','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>17,'id_kategori'=>'15','nama'=>'Caper','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>18,'id_kategori'=>'15','nama'=>'Jalapeno','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>19,'id_kategori'=>'15','nama'=>'Zuchinni','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>20,'id_kategori'=>'15','nama'=>'Lettuce','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>21,'id_kategori'=>'15','nama'=>'Rucolla','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>20,'id_kategori'=>'15','nama'=>'Spinach','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],


        ];

        \DB::table('add_on_menus')->insert($data);
    }
}

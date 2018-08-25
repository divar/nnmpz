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


        ];

        \DB::table('add_on_menus')->insert($data);
    }
}

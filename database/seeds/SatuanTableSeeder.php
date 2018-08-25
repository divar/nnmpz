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
            ['id'=>1,'satuan'=>'Cup, Sedotan, Plastik','created_at'=>date('Y-1-1 00:00:00')],
            ['id'=>2,'satuan'=>'Cup, Sedotan','created_at'=>date('Y-1-1 00:00:00')],
            ['id'=>3,'satuan'=>'Soup Box','created_at'=>date('Y-1-1 00:00:00')],
            ['id'=>4,'satuan'=>'Lunch Box','created_at'=>date('Y-1-1 00:00:00')],
            ['id'=>5,'satuan'=>'Box Reguler','created_at'=>date('Y-1-1 00:00:00')],
            ['id'=>6,'satuan'=>'Box Large','created_at'=>date('Y-1-1 00:00:00')],
            ['id'=>7,'satuan'=>'Cup','created_at'=>date('Y-1-1 00:00:00')],
            ['id'=>7,'satuan'=>'Dessert Box','created_at'=>date('Y-1-1 00:00:00')],
        ];

        \DB::table('satuans')->insert($data);
    }
}

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
        DB::table('kategoris')->delete();

        $data = [
            ['id'=>1,'nama'=>'Milkshake','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>2,'nama'=>'Lassy	','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>3,'nama'=>'Smoothie','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>4,'nama'=>'Special Drink','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>5,'nama'=>'Fresh Juice','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>6,'nama'=>'Antipasti','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>7,'nama'=>'Zuppe','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>8,'nama'=>'Insalata','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>9,'nama'=>'Panini','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>10,'nama'=>'Primi Piatti','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>11,'nama'=>'Secondi','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>12,'nama'=>'Soft Drink','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>13,'nama'=>'Caffetteria','flag_addon'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>14,'nama'=>'DRESSING','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>15,'nama'=>'VEGETABLE','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>16,'nama'=>'MEAT','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>17,'nama'=>'SEAFOOD','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>18,'nama'=>'CHEESE','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>19,'nama'=>'SAUCE','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>20,'nama'=>'FRUIT','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>21,'nama'=>'DOLCI','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>22,'nama'=>'DRINK','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>23,'nama'=>'LAIN-LAIN','flag_addon'=>'Y','created_at'=>date('Y-m-d H:i:s')],
        ];

        \DB::table('kategoris')->insert($data);
    }
}

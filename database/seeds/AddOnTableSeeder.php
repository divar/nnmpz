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
            ['id'=>22,'id_kategori'=>'15','nama'=>'Spinach','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>23,'id_kategori'=>'16','nama'=>'Meat','harga'=>'12000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>24,'id_kategori'=>'16','nama'=>'Chick Petto','harga'=>'12000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>25,'id_kategori'=>'16','nama'=>'Pollo Nanamia','harga'=>'41000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>26,'id_kategori'=>'17','nama'=>'Involtini','harga'=>'50000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>27,'id_kategori'=>'16','nama'=>'Brasato','harga'=>'50000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>28,'id_kategori'=>'17','nama'=>'Anchovie','harga'=>'12000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>29,'id_kategori'=>'17','nama'=>'Seafood','harga'=>'12000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>30,'id_kategori'=>'17','nama'=>'Salmon','harga'=>'12000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>31,'id_kategori'=>'18','nama'=>'Mozzarella','harga'=>'14000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>32,'id_kategori'=>'18','nama'=>'Parmesan','harga'=>'14000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>33,'id_kategori'=>'18','nama'=>'Feta','harga'=>'14000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>34,'id_kategori'=>'18','nama'=>'Ricotta','harga'=>'14000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>35,'id_kategori'=>'19','nama'=>'Creamy Sauce','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>36,'id_kategori'=>'19','nama'=>'Tomato Sauce','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>37,'id_kategori'=>'19','nama'=>'Tomato Olive Sauce','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>38,'id_kategori'=>'19','nama'=>'Mushroom Sauce','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>39,'id_kategori'=>'19','nama'=>'Tomate Paste','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>40,'id_kategori'=>'19','nama'=>'Creamy Spinach','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>41,'id_kategori'=>'19','nama'=>'Brown Sauce','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>42,'id_kategori'=>'19','nama'=>'Bechamel','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>43,'id_kategori'=>'19','nama'=>'Creamy Sauce','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>44,'id_kategori'=>'19','nama'=>'Presto','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>45,'id_kategori'=>'20','nama'=>'Avocado','harga'=>'10000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>46,'id_kategori'=>'20','nama'=>'Pineapple','harga'=>'10000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>47,'id_kategori'=>'21','nama'=>'Coklat Sauce','harga'=>'5000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>48,'id_kategori'=>'21','nama'=>'Blueberry','harga'=>'7000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>49,'id_kategori'=>'21','nama'=>'Ice Cream','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>50,'id_kategori'=>'21','nama'=>'Raspberry Sauce','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>51,'id_kategori'=>'21','nama'=>'Almond Cake','harga'=>'20000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],
            ['id'=>52,'id_kategori'=>'21','nama'=>'Raspberry Granite','harga'=>'8000','keterangan'=>'','created_at'=>date('Y-1-1 H:i:s')],







        ];

        \DB::table('add_on_menus')->insert($data);
    }
}

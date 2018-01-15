<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('list_menus')->delete();

        $data = [
            ['id'=>'1','id_kategori'=>1,'id_satuan'=>4,'nama_menu'=>'Vanilla Milkshake','harga'=>'25000','keterangan'=>'Miilkshake Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'2','id_kategori'=>1,'id_satuan'=>4,'nama_menu'=>'Banana Milkshake','harga'=>'25000','keterangan'=>'Miilkshake Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'3','id_kategori'=>1,'id_satuan'=>4,'nama_menu'=>'Oreo Milkshake','harga'=>'25000','keterangan'=>'Miilkshake Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'4','id_kategori'=>1,'id_satuan'=>4,'nama_menu'=>'Strawberry Milkshake','harga'=>'25000','keterangan'=>'Miilkshake Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'5','id_kategori'=>1,'id_satuan'=>4,'nama_menu'=>'Chocolate Milkshake','harga'=>'25000','keterangan'=>'Miilkshake Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'6','id_kategori'=>1,'id_satuan'=>4,'nama_menu'=>'Blueberry Milkshake','harga'=>'25000','keterangan'=>'Miilkshake Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'7','id_kategori'=>1,'id_satuan'=>4,'nama_menu'=>'Raspberry Milkshake','harga'=>'25000','keterangan'=>'Miilkshake Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'8','id_kategori'=>1,'id_satuan'=>4,'nama_menu'=>'Coffee Milkshake','harga'=>'25000','keterangan'=>'Miilkshake Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],

            ['id'=>'9','id_kategori'=>2,'id_satuan'=>4,'nama_menu'=>'Plain Lassy','harga'=>'19000','keterangan'=>'Lassy Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'10','id_kategori'=>2,'id_satuan'=>4,'nama_menu'=>'Strawberry Lassy','harga'=>'24000','keterangan'=>'Lassy Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'11','id_kategori'=>2,'id_satuan'=>4,'nama_menu'=>'Banana Lassy','harga'=>'24000','keterangan'=>'Lassy Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'12','id_kategori'=>2,'id_satuan'=>4,'nama_menu'=>'Pineapple Lassy','harga'=>'24000','keterangan'=>'Lassy Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'13','id_kategori'=>2,'id_satuan'=>4,'nama_menu'=>'Manggo Lassy','harga'=>'24000','keterangan'=>'Lassy Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'14','id_kategori'=>2,'id_satuan'=>4,'nama_menu'=>'Bluberry Lassy','harga'=>'24000','keterangan'=>'Lassy Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'15','id_kategori'=>2,'id_satuan'=>4,'nama_menu'=>'Raspberry Lassy','harga'=>'24000','keterangan'=>'Lassy Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],

            ['id'=>'16','id_kategori'=>3,'id_satuan'=>4,'nama_menu'=>'Strawberry Smoothie','harga'=>'25000','keterangan'=>'Smoothie Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'17','id_kategori'=>3,'id_satuan'=>4,'nama_menu'=>'Banana Smoothie','harga'=>'25000','keterangan'=>'Smoothie Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'18','id_kategori'=>3,'id_satuan'=>4,'nama_menu'=>'Manggo Smoothie','harga'=>'25000','keterangan'=>'Smoothie Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'19','id_kategori'=>3,'id_satuan'=>4,'nama_menu'=>'Blueberry Smoothie','harga'=>'25000','keterangan'=>'Smoothie Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'20','id_kategori'=>3,'id_satuan'=>4,'nama_menu'=>'Raspberry Smoothie','harga'=>'25000','keterangan'=>'Smoothie Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],

            ['id'=>'21','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Mango  Frullato','harga'=>'23000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'22','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Limentina	','harga'=>'23000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'23','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Pame Menta','harga'=>'23000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'24','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Litchi Al Arancia','harga'=>'23000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'25','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Litchi Limonela','harga'=>'23000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'26','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Limontazera','harga'=>'23000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'27','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Giastro','harga'=>'25000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'28','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Mirtillo Menta','harga'=>'25000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'29','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Bananaberry','harga'=>'25000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'30','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Berrymia','harga'=>'25000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'31','id_kategori'=>4,'id_satuan'=>4,'nama_menu'=>'Avocado Nero','harga'=>'25000','keterangan'=>'Special Drink Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],

            ['id'=>'32','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Papaya','harga'=>'17000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'33','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Melon','harga'=>'17000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'34','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Pineapple','harga'=>'17000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'35','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Tomato','harga'=>'17000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'36','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Orange','harga'=>'17000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'37','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Lime','harga'=>'17000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'38','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Banana','harga'=>'17000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'39','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Manggo','harga'=>'21000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'40','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Strawberry','harga'=>'21000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'41','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Water Melon','harga'=>'21000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'42','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Blueberry','harga'=>'23000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'43','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Avocado','harga'=>'23000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'44','id_kategori'=>5,'id_satuan'=>4,'nama_menu'=>'Raspberry','harga'=>'23000','keterangan'=>'Fresh Juice Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],

            ['id'=>'45','id_kategori'=>6,'id_satuan'=>3,'nama_menu'=>'Pane Aglio','harga'=>'15000','keterangan'=>'Antipasti Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'46','id_kategori'=>6,'id_satuan'=>3,'nama_menu'=>'Bruschetta','harga'=>'18000','keterangan'=>'Antipasti Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'47','id_kategori'=>6,'id_satuan'=>3,'nama_menu'=>'Bruschetta al Forno','harga'=>'22000','keterangan'=>'Antipasti Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'48','id_kategori'=>6,'id_satuan'=>3,'nama_menu'=>'Crostini','harga'=>'22000','keterangan'=>'Antipasti Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'49','id_kategori'=>6,'id_satuan'=>3,'nama_menu'=>'Oven Baked Potato','harga'=>'22000','keterangan'=>'Antipasti Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'50','id_kategori'=>6,'id_satuan'=>3,'nama_menu'=>'Panzerotti al Spinaci con Ricotta','harga'=>'24000','keterangan'=>'Antipasti Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'51','id_kategori'=>6,'id_satuan'=>3,'nama_menu'=>'Panzerotti al Pollo con Vendura','harga'=>'24000','keterangan'=>'Antipasti Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'52','id_kategori'=>6,'id_satuan'=>3,'nama_menu'=>'Pipite di Pollo','harga'=>'28000','keterangan'=>'Antipasti Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'53','id_kategori'=>6,'id_satuan'=>3,'nama_menu'=>'Mozzarelle Fritte','harga'=>'31000','keterangan'=>'Antipasti Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'54','id_kategori'=>6,'id_satuan'=>3,'nama_menu'=>'Piatto Soffritto con Ricota','harga'=>'35000','keterangan'=>'Antipasti Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],

            ['id'=>'55','id_kategori'=>7,'id_satuan'=>3,'nama_menu'=>'Minestrone','harga'=>'27000','keterangan'=>'Zupe Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'56','id_kategori'=>7,'id_satuan'=>3,'nama_menu'=>'Funghi','harga'=>'27000','keterangan'=>'Zupe Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'57','id_kategori'=>7,'id_satuan'=>3,'nama_menu'=>'Pomodori e Basilico','harga'=>'27000','keterangan'=>'Zupe Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'58','id_kategori'=>7,'id_satuan'=>3,'nama_menu'=>'Del Mare','harga'=>'30000','keterangan'=>'Zupe Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'59','id_kategori'=>7,'id_satuan'=>3,'nama_menu'=>'Bocconcini','harga'=>'30000','keterangan'=>'Zupe Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],

            ['id'=>'60','id_kategori'=>8,'id_satuan'=>3,'nama_menu'=>'Insalata Caesaro','harga'=>'36000','keterangan'=>'Insalata','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'61','id_kategori'=>8,'id_satuan'=>3,'nama_menu'=>'Insalata Primavera','harga'=>'36000','keterangan'=>'Insalata','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'62','id_kategori'=>8,'id_satuan'=>3,'nama_menu'=>'Insalata la Marche','harga'=>'36000','keterangan'=>'Insalata','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'63','id_kategori'=>8,'id_satuan'=>3,'nama_menu'=>'Insalata di Tonno','harga'=>'36000','keterangan'=>'Insalata','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'64','id_kategori'=>8,'id_satuan'=>3,'nama_menu'=>'Insalata Mediterranea','harga'=>'36000','keterangan'=>'Insalata','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],

            ['id'=>'65','id_kategori'=>9,'id_satuan'=>3,'nama_menu'=>'Panino di Verdure','harga'=>'38000','keterangan'=>'Panini Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'66','id_kategori'=>9,'id_satuan'=>3,'nama_menu'=>'Panino di Carne','harga'=>'38000','keterangan'=>'Panini Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'67','id_kategori'=>9,'id_satuan'=>3,'nama_menu'=>'Panino al Tonno e Uovo','harga'=>'38000','keterangan'=>'Panini Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'68','id_kategori'=>9,'id_satuan'=>3,'nama_menu'=>'Panino al Pollo e Pesto','harga'=>'38000','keterangan'=>'Panini Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'69','id_kategori'=>9,'id_satuan'=>3,'nama_menu'=>'Panino Calabrese','harga'=>'38000','keterangan'=>'Panini Menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],

            ['id'=>'70','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Spaghetti Aglio e Qlio','harga'=>'32000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'71','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Spaghetti alla Crudaida','harga'=>'32000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'72','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Fettucine al Pesto','harga'=>'35000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'73','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Fettucine Funghi','harga'=>'35000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'74','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Fettucine Alfredo','harga'=>'35000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'75','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Fettucine Carbonara','harga'=>'35000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'76','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Penne al Arrabiata','harga'=>'35000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'77','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Spaghetti Bolognese','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'78','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Spaghetti al Tonno Piccante','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'79','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Penne con Pollo e Patate','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'80','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Spaghetti Marinara','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'81','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Penne al Pollo Picante','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'82','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Ndundari al Ricotta','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'83','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Lasagna Classica','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'84','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Ravioli Nanazzita','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'85','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Cannelonni ai Spinci','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'86','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Cannelonni al Tonno','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'87','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Penne Salmone','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'88','id_kategori'=>10,'id_satuan'=>3,'nama_menu'=>'Tortellini con Salsa di Noci','harga'=>'39000','keterangan'=>'Primi Piati menu','id_size'=>null,'created_at'=>date('Y-m-d H:i:s')],

            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
            // ['id'=>1,'id_kategori'=>'xxx','id_satuan'=>'Satuan','nama_menu'=>'Menu','harga'=>'Harga','keterangan'=>'Keter','id_size'=>'Size','created_at'=>date('Y-m-d H:i:s')],
        ];

        \DB::table('list_menus')->insert($data);
    }
}

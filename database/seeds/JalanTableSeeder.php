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
            ['id'=>1,'id_tarif_wilayah'=>1,'nama'=>'Jl. Jogjakarta no.1','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>2,'id_tarif_wilayah'=>2,'nama'=>'Jl. Jogjakarta no.2','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>3,'id_tarif_wilayah'=>3,'nama'=>'Jl. Jogjakarta no.3','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>4,'id_tarif_wilayah'=>4,'nama'=>'Jl. Jogjakarta no.4','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>5,'id_tarif_wilayah'=>5,'nama'=>'Jl. Jogjakarta no.5','created_at'=>date('Y-m-d H:i:s')],
            ['id'=>6,'id_tarif_wilayah'=>6,'nama'=>'Jl. Jogjakarta no.6','created_at'=>date('Y-m-d H:i:s')],
        ];

        \DB::table('jalans')->insert($data);
    }
}

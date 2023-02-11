<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Remove All Record*/
        DB::table('product_attributes')->delete();
        /*Import*/
        DB::table('product_attributes')->insert([
            [
                'attribute_id' => 1,
                'product_id' => 1,
                'value' => 'پنبه ای',
                'is_active' => 1,
            ],
        ]);
    }
}

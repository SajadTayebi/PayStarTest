<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariationSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Remove All Record*/
        DB::table('product_variations')->delete();
        /*Import*/
        DB::table('product_variations')->insert([
            [
                'attribute_id' => 4,
                'product_id' => 1,
                'value' => 'M',
                'price' => 5000,
                'quantity' => 3,
                'sku' => '123',
            ],
        ]);
    }
}

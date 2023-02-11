<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Remove All Record*/
        DB::table('products')->delete();
        /*Import*/
        DB::table('products')->insert([
            [
                'name' => 'مردانه',
                'brand_id' => 1,
                'category_id' => 1,
                'slug' => 'محصول-اول',
                'primary_image' => '2020_12_10_1_10_29_377468_1.jpg',
                'description' => 'محصول اول محصول اول محصول اول محصول اول محصول اول محصول اول محصول اول محصول اول',
                'status' => 1,
                'is_active' => 1,
                'delivery_amount' => 0,
                'delivery_amount_per_product' => 0
            ],
        ]);
    }
}

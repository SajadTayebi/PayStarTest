<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Remove All Record*/
        DB::table('categories')->delete();
        /*Import*/
        DB::table('categories')->insert([
            [
                'name' => 'مردانه',
                'slug' => 'mens',
                'parent_id' => 1
            ],
            [
                'name' => 'زنانه',
                'slug' => 'womens',
                'parent_id' => 0
            ],
        ]);
    }
}

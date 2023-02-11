<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Remove All Record*/
        DB::table('brands')->delete();
        /*Import*/
        DB::table('brands')->insert([
            [
                'name' => 'برند یک',
                'is_active' => 1
            ],
            [
                'name' => 'برند دو',
                'is_active' => 0
            ],
        ]);
    }
}

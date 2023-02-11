<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Remove All Record*/
        DB::table('attributes')->delete();
        /*Import*/
        DB::table('attributes')->insert([
            [
                'name' => 'جنس'
            ],
            [
                'name' => 'طرح پارچه'
            ],
            [
                'name' => 'رنگ'
            ],
            [
                'name' => 'سایز'
            ]
        ]);
    }
}

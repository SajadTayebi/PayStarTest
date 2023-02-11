<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BannerSeederTable::class);
        $this->call(AttributeSeederTable::class);
        $this->call(BrandSeederTable::class);
        $this->call(CategorySeederTable::class);
        $this->call(ProvinceSeederTable::class);
        $this->call(CitySeederTable::class);
        $this->call(ProductSeederTable::class);
        $this->call(ProductAttributeSeederTable::class);
        $this->call(ProductVariationSeederTable::class);
    }
}

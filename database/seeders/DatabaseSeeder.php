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
        $this->call(UserSeeder::class);
        $this->call(GroupDefectSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(ProductClassSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(FabricSeeder::class);
        $this->call(AllowanceSmvSeeder::class);
    }
}

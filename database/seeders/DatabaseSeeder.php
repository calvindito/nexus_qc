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
        $this->call(ActivityLogSeeder::class);
        $this->call(AllowanceSmvSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(BuyerSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(FabricSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(GroupDefectSeeder::class);
        $this->call(JobDescSeeder::class);
        $this->call(LineSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(ProductClassSeeder::class);
        $this->call(ProductGroupSeeder::class);
        $this->call(ProductionSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(StandartMinuteValueSeeder::class);
        $this->call(StyleSeeder::class);
        $this->call(TokenSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WorkingHoursChartSeeder::class);
        $this->call(WorkingHoursTypeSeeder::class);
    }
}

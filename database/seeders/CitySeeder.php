<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($cities as $c) {
            City::insert([
                'id'          => $c['id'],
                'province_id' => $c['province_id'],
                'name'        => $c['name'],
                'latitude'    => $c['latitude'],
                'longitude'   => $c['longitude'],
                'created_at'  => $c['created_at'],
                'updated_at'  => $c['updated_at'],
                'deleted_at'  => $c['deleted_at']
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($provinces as $p) {
            Province::insert([
                'id'         => $p['id'],
                'country_id' => $p['country_id'],
                'name'       => $p['name'],
                'latitude'   => $p['latitude'],
                'longitude'  => $p['longitude'],
                'created_at' => $p['created_at'],
                'updated_at' => $p['updated_at'],
                'deleted_at' => $p['deleted_at']
            ]);
        }
    }
}

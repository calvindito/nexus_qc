<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($countries as $c) {
            Country::insert([
                'id'         => $c['id'],
                'code'       => $c['code'],
                'name'       => $c['name'],
                'created_at' => $c['created_at'],
                'updated_at' => $c['updated_at'],
                'deleted_at' => $c['deleted_at']
            ]);
        }
    }
}

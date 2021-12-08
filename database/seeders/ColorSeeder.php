<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($colors as $c) {
            Color::insert([
                'id'         => $c['id'],
                'brand_id'   => $c['brand_id'],
                'fabric_id'  => $c['fabric_id'],
                'created_by' => $c['created_by'],
                'updated_by' => $c['updated_by'],
                'name'       => $c['name'],
                'status'     => $c['status'],
                'created_at' => $c['created_at'],
                'updated_at' => $c['updated_at'],
                'deleted_at' => $c['deleted_at']
            ]);
        }
    }
}

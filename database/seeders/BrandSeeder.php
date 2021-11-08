<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($brands as $b) {
            Brand::insert([
                'id'         => $b['id'],
                'created_by' => $b['created_by'],
                'updated_by' => $b['updated_by'],
                'name'       => $b['name'],
                'aql'        => $b['aql'],
                'status'     => $b['status'],
                'created_at' => $b['created_at'],
                'updated_at' => $b['updated_at'],
                'deleted_at' => $b['deleted_at']
            ]);
        }
    }
}

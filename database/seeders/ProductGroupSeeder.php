<?php

namespace Database\Seeders;

use App\Models\ProductGroup;
use Illuminate\Database\Seeder;

class ProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($product_groups as $pg) {
            ProductGroup::insert([
                'id'         => $pg['id'],
                'created_by' => $pg['created_by'],
                'updated_by' => $pg['updated_by'],
                'name'       => $pg['name'],
                'status'     => $pg['status'],
                'created_at' => $pg['created_at'],
                'updated_at' => $pg['updated_at'],
                'deleted_at' => $pg['deleted_at']
            ]);
        }
    }
}

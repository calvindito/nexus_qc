<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($product_types as $pt) {
            ProductType::insert([
                'id'               => $pt['id'],
                'product_class_id' => $pt['product_class_id'],
                'size_id'          => $pt['size_id'],
                'created_by'       => $pt['created_by'],
                'updated_by'       => $pt['updated_by'],
                'name'             => $pt['name'],
                'smv_global'       => $pt['smv_global'],
                'description'      => $pt['description'],
                'status'           => $pt['status'],
                'created_at'       => $pt['created_at'],
                'updated_at'       => $pt['updated_at'],
                'deleted_at'       => $pt['deleted_at']
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProductClass;
use Illuminate\Database\Seeder;
use App\Models\ProductClassDetail;

class ProductClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($product_classes as $pc) {
            ProductClass::insert([
                'id'         => $pc['id'],
                'created_by' => $pc['created_by'],
                'updated_by' => $pc['updated_by'],
                'name'       => $pc['name'],
                'status'     => $pc['status'],
                'created_at' => $pc['created_at'],
                'updated_at' => $pc['updated_at'],
                'deleted_at' => $pc['deleted_at']
            ]);
        }
    }
}

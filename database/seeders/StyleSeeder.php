<?php

namespace Database\Seeders;

use App\Models\Style;
use Illuminate\Database\Seeder;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($styles as $s) {
            Style::insert([
                'id'               => $s['id'],
                'product_class_id' => $s['product_class_id'],
                'product_type_id'  => $s['product_type_id'],
                'brand_id'         => $s['brand_id'],
                'size_id'          => $s['size_id'],
                'created_by'       => $s['created_by'],
                'updated_by'       => $s['updated_by'],
                'name'             => $s['name'],
                'status'           => $s['status'],
                'created_at'       => $s['created_at'],
                'updated_at'       => $s['updated_at'],
                'deleted_at'       => $s['deleted_at']
            ]);
        }
    }
}

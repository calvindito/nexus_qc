<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;
use App\Models\ProductTypeDefect;
use App\Models\ProductTypeCheckPoint;

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

        foreach($product_type_check_points as $ptcp) {
            ProductTypeCheckPoint::insert([
                'id'              => $ptcp['id'],
                'product_type_id' => $ptcp['product_type_id'],
                'check_point_id'  => $ptcp['check_point_id'],
                'created_at'      => $ptcp['created_at'],
                'updated_at'      => $ptcp['updated_at']
            ]);
        }

        foreach($product_type_defects as $ptd) {
            ProductTypeDefect::insert([
                'id'                          => $ptd['id'],
                'product_type_id'             => $ptd['product_type_id'],
                'product_type_check_point_id' => $ptd['product_type_check_point_id'],
                'group_defect_id'             => $ptd['group_defect_id'],
                'created_at'                  => $ptd['created_at'],
                'updated_at'                  => $ptd['updated_at']
            ]);
        }
    }
}

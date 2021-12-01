<?php

namespace Database\Seeders;

use App\Models\Production;
use Illuminate\Database\Seeder;
use App\Models\ProductionDetail;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($productions as $p) {
            Production::insert([
                'id'              => $p['id'],
                'buyer_id'        => $p['buyer_id'],
                'style_id'        => $p['style_id'],
                'city_id'         => $p['city_id'],
                'code_production' => $p['code_production'],
                'code_job_order'  => $p['code_job_order'],
                'code_buyer'      => $p['code_buyer'],
                'delivery_date'   => $p['delivery_date'],
                'created_at'      => $p['created_at'],
                'updated_at'      => $p['updated_at'],
                'deleted_at'      => $p['deleted_at']
            ]);
        }

        foreach($production_details as $pd) {
            ProductionDetail::insert([
                'id'             => $pd['id'],
                'production_id'  => $pd['production_id'],
                'color_id'       => $pd['color_id'],
                'size_detail_id' => $pd['size_detail_id'],
                'qty'            => $pd['qty'],
                'created_at'     => $pd['created_at'],
                'updated_at'     => $pd['updated_at']
            ]);
        }
    }
}

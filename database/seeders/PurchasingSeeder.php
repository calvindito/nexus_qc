<?php

namespace Database\Seeders;

use App\Models\Purchasing;
use Illuminate\Database\Seeder;
use App\Models\PurchasingDetail;

class PurchasingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($purchasings as $p) {
            Purchasing::insert([
                'id'            => $p['id'],
                'buyer_id'      => $p['buyer_id'],
                'style_id'      => $p['style_id'],
                'city_id'       => $p['city_id'],
                'code'          => $p['code'],
                'price'         => $p['price'],
                'tax'           => $p['tax'],
                'delivery_date' => $p['delivery_date'],
                'created_at'    => $p['created_at'],
                'updated_at'    => $p['updated_at'],
                'deleted_at'    => $p['deleted_at']
            ]);
        }

        foreach($purchasing_details as $pd) {
            PurchasingDetail::insert([
                'id'             => $pd['id'],
                'purchasing_id'  => $pd['purchasing_id'],
                'color_id'       => $pd['color_id'],
                'size_detail_id' => $pd['size_detail_id'],
                'qty'            => $pd['qty'],
                'created_at'     => $pd['created_at'],
                'updated_at'     => $pd['updated_at']
            ]);
        }
    }
}

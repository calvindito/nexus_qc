<?php

namespace Database\Seeders;

use App\Models\SalesOrder;
use Illuminate\Database\Seeder;
use App\Models\SalesOrderDetail;

class SalesOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($sales_orders as $so) {
            SalesOrder::insert([
                'id'            => $so['id'],
                'buyer_id'      => $so['buyer_id'],
                'style_id'      => $so['style_id'],
                'city_id'       => $so['city_id'],
                'code'          => $so['code'],
                'price'         => $so['price'],
                'tax'           => $so['tax'],
                'delivery_date' => $so['delivery_date'],
                'created_at'    => $so['created_at'],
                'updated_at'    => $so['updated_at'],
                'deleted_at'    => $so['deleted_at']
            ]);
        }

        foreach($sales_order_details as $sod) {
            SalesOrderDetail::insert([
                'id'             => $pd['id'],
                'sales_order_id' => $pd['sales_order_id'],
                'color_id'       => $pd['color_id'],
                'size_detail_id' => $pd['size_detail_id'],
                'qty'            => $pd['qty'],
                'created_at'     => $pd['created_at'],
                'updated_at'     => $pd['updated_at']
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\BuyerContact;
use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($buyers as $b) {
            Buyer::insert([
                'id'             => $b['id'],
                'country_id'     => $b['country_id'],
                'province_id'    => $b['province_id'],
                'city_id'        => $b['city_id'],
                'departement_id' => $b['departement_id'],
                'rank_id'        => $b['rank_id'],
                'created_by'     => $b['created_by'],
                'updated_by'     => $b['updated_by'],
                'company'        => $b['company'],
                'description'    => $b['description'],
                'remark'         => $b['remark'],
                'address'        => $b['address'],
                'status'         => $b['status'],
                'created_at'     => $b['created_at'],
                'updated_at'     => $b['updated_at'],
                'deleted_at'     => $b['deleted_at']
            ]);
        }

        foreach($buyer_contacts as $bc) {
            BuyerContact::insert([
                'id'         => $bc['id'],
                'buyer_id'   => $bc['buyer_id'],
                'rank_id'    => $bc['rank_id'],
                'name'       => $bc['name'],
                'value'      => $bc['value'],
                'type'       => $bc['type'],
                'created_at' => $bc['created_at'],
                'updated_at' => $bc['updated_at']
            ]);
        }
    }
}

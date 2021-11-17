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
                'id'              => $s['id'],
                'brand_id'        => $s['brand_id'],
                'product_type_id' => $s['product_type_id'],
                'created_by'      => $s['created_by'],
                'updated_by'      => $s['updated_by'],
                'code'            => $s['code'],
                'name'            => $s['name'],
                'status'          => $s['status'],
                'created_at'      => $s['created_at'],
                'updated_at'      => $s['updated_at'],
                'deleted_at'      => $s['deleted_at']
            ]);
        }
    }
}

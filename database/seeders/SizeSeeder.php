<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\SizeDetail;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($sizes as $s) {
            Size::insert([
                'id'         => $s['id'],
                'created_by' => $s['created_by'],
                'updated_by' => $s['updated_by'],
                'group'      => $s['group'],
                'status'     => $s['status'],
                'created_at' => $s['created_at'],
                'updated_at' => $s['updated_at'],
                'deleted_at' => $s['deleted_at']
            ]);
        }

        foreach($size_details as $sd) {
            SizeDetail::insert([
                'id'         => $sd['id'],
                'size_id'    => $sd['size_id'],
                'value'      => $sd['value'],
                'created_at' => $sd['created_at'],
                'updated_at' => $sd['updated_at']
            ]);
        }
    }
}

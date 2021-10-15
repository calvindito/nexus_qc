<?php

namespace Database\Seeders;

use App\Models\CheckPoint;
use Illuminate\Database\Seeder;

class CheckPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($check_points as $cp) {
            CheckPoint::insert([
                'id'         => $cp['id'],
                'created_by' => $cp['created_by'],
                'updated_by' => $cp['updated_by'],
                'code'       => $cp['code'],
                'name'       => $cp['name'],
                'status'     => $cp['status'],
                'created_at' => $cp['created_at'],
                'updated_at' => $cp['updated_at'],
                'deleted_at' => $cp['deleted_at']
            ]);
        }
    }
}

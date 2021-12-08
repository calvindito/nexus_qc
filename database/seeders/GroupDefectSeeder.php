<?php

namespace Database\Seeders;

use App\Models\GroupDefect;
use Illuminate\Database\Seeder;

class GroupDefectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($group_defects as $gd) {
            GroupDefect::insert([
                'id'         => $gd['id'],
                'created_by' => $gd['created_by'],
                'updated_by' => $gd['updated_by'],
                'name'       => $gd['name'],
                'type'       => $gd['type'],
                'status'     => $gd['status'],
                'created_at' => $gd['created_at'],
                'updated_at' => $gd['updated_at'],
                'deleted_at' => $gd['deleted_at']
            ]);
        }
    }
}

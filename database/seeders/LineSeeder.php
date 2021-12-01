<?php

namespace Database\Seeders;

use App\Models\Line;
use Illuminate\Database\Seeder;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($lines as $l) {
            Line::insert([
                'id'         => $l['id'],
                'section'    => $l['section_id'],
                'created_by' => $l['created_by'],
                'updated_by' => $l['updated_by'],
                'name'       => $l['name'],
                'status'     => $l['status'],
                'created_at' => $l['created_at'],
                'updated_at' => $l['updated_at'],
                'deleted_at' => $l['deleted_at']
            ]);
        }
    }
}

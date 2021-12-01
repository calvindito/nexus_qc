<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($sections as $s) {
            Section::insert([
                'id'             => $s['id'],
                'departement_id' => $s['departement_id'],
                'created_by'     => $s['created_by'],
                'updated_by'     => $s['updated_by'],
                'name'           => $s['name'],
                'status'         => $s['status'],
                'created_at'     => $s['created_at'],
                'updated_at'     => $s['updated_at'],
                'deleted_at'     => $s['deleted_at']
            ]);
        }
    }
}

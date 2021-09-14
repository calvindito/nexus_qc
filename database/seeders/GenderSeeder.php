<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($genders as $g) {
            Gender::insert([
                'id'         => $g['id'],
                'created_by' => $g['created_by'],
                'updated_by' => $g['updated_by'],
                'name'       => $g['name'],
                'status'     => $g['status'],
                'created_at' => $g['created_at'],
                'updated_at' => $g['updated_at'],
                'deleted_at' => $g['deleted_at']
            ]);
        }
    }
}

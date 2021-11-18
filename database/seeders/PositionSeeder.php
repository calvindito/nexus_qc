<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($positions as $p) {
            Position::insert([
                'id'         => $p['id'],
                'created_by' => $p['created_by'],
                'updated_by' => $p['updated_by'],
                'code'       => $p['code'],
                'name'       => $p['name'],
                'status'     => $p['status'],
                'created_at' => $p['created_at'],
                'updated_at' => $p['updated_at'],
                'deleted_at' => $p['deleted_at']
            ]);
        }
    }
}

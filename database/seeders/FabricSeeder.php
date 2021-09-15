<?php

namespace Database\Seeders;

use App\Models\Fabric;
use Illuminate\Database\Seeder;

class FabricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($fabrics as $f) {
            Fabric::insert([
                'id'          => $f['id'],
                'created_by'  => $f['created_by'],
                'updated_by'  => $f['updated_by'],
                'name'        => $f['name'],
                'description' => $f['description'],
                'status'      => $f['status'],
                'created_at'  => $f['created_at'],
                'updated_at'  => $f['updated_at'],
                'deleted_at'  => $f['deleted_at']
            ]);
        }
    }
}

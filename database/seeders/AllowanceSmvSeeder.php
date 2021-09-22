<?php

namespace Database\Seeders;

use App\Models\AllowanceSmv;
use Illuminate\Database\Seeder;

class AllowanceSmvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($allowance_smvs as $as) {
            AllowanceSmv::insert([
                'id'          => $as['id'],
                'created_by'  => $as['created_by'],
                'updated_by'  => $as['updated_by'],
                'name'        => $as['name'],
                'description' => $as['description'],
                'created_at'  => $as['created_at'],
                'updated_at'  => $as['updated_at'],
                'deleted_at'  => $as['deleted_at']
            ]);
        }
    }
}

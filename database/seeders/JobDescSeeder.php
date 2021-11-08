<?php

namespace Database\Seeders;

use App\Models\JobDesc;
use Illuminate\Database\Seeder;

class JobDescSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($job_descs as $jd) {
            JobDesc::insert([
                'id'          => $jd['id'],
                'created_by'  => $jd['created_by'],
                'updated_by'  => $jd['updated_by'],
                'name'        => $jd['name'],
                'description' => $jd['parent_id'],
                'status'      => $jd['status'],
                'created_at'  => $jd['created_at'],
                'updated_at'  => $jd['updated_at'],
                'deleted_at'  => $jd['deleted_at']
            ]);
        }
    }
}

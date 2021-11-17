<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($activity_logs as $al) {
            ActivityLog::insert([
                'id'           => $al['id'],
                'log_name'     => $al['log_name'],
                'description'  => $al['description'],
                'subject_type' => $al['subject_type'],
                'subject_id'   => $al['subject_id'],
                'causer_type'  => $al['causer_type'],
                'causer_id'    => $al['causer_id'],
                'properties'   => $al['properties'],
                'created_at'   => $al['created_at'],
                'updated_at'   => $al['updated_at']
            ]);
        }
    }
}

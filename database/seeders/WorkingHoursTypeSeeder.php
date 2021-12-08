<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkingHoursType;
use App\Models\WorkingHoursTypeDetail;

class WorkingHoursTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($working_hours_types as $wht) {
            WorkingHoursType::insert([
                'id'             => $wht['id'],
                'created_by'     => $wht['created_by'],
                'updated_by'     => $wht['updated_by'],
                'name'           => $wht['total_working_day'],
                'name'           => $wht['late_tolerance'],
                'status'         => $wht['status'],
                'created_at'     => $wht['created_at'],
                'updated_at'     => $wht['updated_at'],
                'deleted_at'     => $wht['deleted_at']
            ]);
        }

        foreach($working_hours_type_details as $whtd) {
            WorkingHoursTypeDetail::insert([
                'id'                    => $whtd['id'],
                'working_hours_type_id' => $whtd['working_hours_type_id'],
                'start_time'            => $whtd['start_time'],
                'end_time'              => $whtd['end_time'],
                'shift'                 => $whtd['status'],
                'created_at'            => $whtd['created_at'],
                'updated_at'            => $whtd['updated_at']
            ]);
        }
    }
}

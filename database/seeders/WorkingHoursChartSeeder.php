<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkingHoursChart;

class WorkingHoursChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($working_hours_charts as $whc) {
            WorkingHoursChart::insert([
                'id'                    => $whc['id'],
                'working_hours_type_id' => $whc['working_hours_type_id'],
                'company_id'            => $whc['company_id'],
                'branch_id'             => $whc['branch_id'],
                'division_id'           => $whc['division_id'],
                'departement_id'        => $whc['departement_id'],
                'section_id'            => $whc['section_id'],
                'line_id'               => $whc['line_id'],
                'start_date'            => $whc['start_date'],
                'end_date'              => $whc['end_date'],
                'created_at'            => $whc['created_at'],
                'updated_at'            => $whc['updated_at']
            ]);
        }
    }
}

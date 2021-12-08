<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StandartMinuteValue;

class StandartMinuteValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($standart_minute_values as $smv) {
            StandartMinuteValue::insert([
                'id'         => $smv['id'],
                'style_id'   => $smv['style_id'],
                'created_by' => $smv['created_by'],
                'updated_by' => $smv['updated_by'],
                'target'     => $smv['target'],
                'status'     => $smv['status'],
                'created_at' => $smv['created_at'],
                'updated_at' => $smv['updated_at'],
                'deleted_at' => $smv['deleted_at']
            ]);
        }
    }
}

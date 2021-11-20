<?php

namespace Database\Seeders;

use App\Models\Token;
use Illuminate\Database\Seeder;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($tokens as $t) {
            Token::insert([
                'id'         => $t['id'],
                'user_id'    => $t['user_id'],
                'code'       => $t['code'],
                'valid_at'   => $t['valid_at'],
                'activated'  => $t['activated'],
                'created_at' => $t['created_at'],
                'updated_at' => $t['updated_at']
            ]);
        }
    }
}

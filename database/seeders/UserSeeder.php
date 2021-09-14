<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require public_path('website/backup.php');

        foreach($users as $u) {
            User::insert([
                'id'         => $u['id'],
                'created_by' => $u['created_by'],
                'updated_by' => $u['updated_by'],
                'image'      => $u['image'],
                'username'   => $u['username'],
                'name'       => $u['name'],
                'email'      => $u['email'],
                'gender'     => $u['gender'],
                'password'   => $u['password'],
                'status'     => $u['status'],
                'created_at' => $u['created_at'],
                'updated_at' => $u['updated_at'],
                'deleted_at' => $u['deleted_at']
            ]);
        }
    }
}

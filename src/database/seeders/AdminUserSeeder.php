<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin User',
            'email' => 'admin_User@example.com',
            'password' => Hash::make('admin_user_1031'), // パスワードはハッシュ化
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

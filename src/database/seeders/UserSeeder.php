<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DELETE FROM users");
        $date = Carbon::now();
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => "super admin",
                'email' => "superadmin@gmail.com",
                'password' => Hash::make(123456),
                'is_admin' => true,
                'is_active' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ]
        ]);
    }
}

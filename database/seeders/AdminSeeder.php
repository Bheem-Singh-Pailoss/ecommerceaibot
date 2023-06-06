<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admins;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            ['name'  => 'Admin','email' => 'admin@admin.com','password' =>bcrypt('password')],
        ];
        \App\Models\Admins::create($admin);
    }
}

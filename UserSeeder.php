<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Admin",
            "ttl" => "None",
            "alamat" => "None",
            "email" => "admin@transkoetaradja.co.id",
            "username" => "admin",
            "password" => bcrypt("123"),
            "role" => "Admin",
        ]);
    }
}

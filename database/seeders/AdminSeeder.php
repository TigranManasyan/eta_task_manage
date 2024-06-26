<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "name" => "Admin Test",
            "email" => "test@mail.ru",
            "password" => Hash::make(1234)
        ]);

        $user->assignRole("admin");
    }
}

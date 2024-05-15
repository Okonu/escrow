<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'John Doe',
            'username' => 'jdoe',
            'email' => 'johndoe@mail.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
        ]);

        UserDetails::create([
            'user_id' => $user->id,
            'account_no' => rand(10000000, 99999999),
            'address' => '123 Main St, Anytown, KE',
            'date_of_birth' => now()->subYears(30)->format('Y-m-d'),
        ]);
    }
}

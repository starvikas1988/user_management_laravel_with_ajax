<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
       // User::factory()->count(10)->create();

       $faker = Faker::create();
       $role = \App\Models\Role::where('role_name', 'User')->first();
       $role_admin = \App\Models\Role::where('role_name', 'Admin')->first();

        // Loop to create 20 user entries
        for ($i = 1; $i <= 20; $i++) {
            User::factory()->create([
                'name' => $faker->name, // Generates random names
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->unique()->numerify('89105997##'), // Random Indian phone number pattern
                'password' => Hash::make('password'),
                'description' => 'user ' . $i,
                'role_id' => $role->id,
                'profile_image' => 'images/profile' . $i . '.jpg',
            ]);
        }

        User::factory()->create([
           
            'name' => 'Admin',
            'email' => 'admin123@example.com',
            'phone' => '8910599783', // Make sure to provide a phone number
            'password' => Hash::make('password'),
            'description' => 'Admin',
            'role_id' => $role_admin->id,
            'profile_image' => 'images/profile2.jpg'
           
        ]);
    }
}

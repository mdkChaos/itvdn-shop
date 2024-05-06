<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();

        User::factory()->create([
            'name' => $faker->userName,
            'lastName' => $faker->lastName,
            'email' => 'admin@laravel-shop.test',
            'password' => Hash::make('secret'),
            'is_admin' => true,
        ]);

        for ($i = 0; $i < 10; $i++) {
            User::factory()->create([
                'name' => $faker->userName,
                'lastName' => $faker->lastName,
                'email' => $faker->email,
                'password' => Hash::make('secret'),
            ]);
        }
    }
}

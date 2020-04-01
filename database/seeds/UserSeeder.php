<?php

use Illuminate\Database\Seeder;
use App\User;
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
        $testUser = User::whereEmail('test@test.com')->first();

        if (!$testUser) {
            User::create([
                'name' => 'test',
                'email' => 'test@test.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainUser = User::query()
            ->where('email', '=', env('MAIN_USER_EMAIL'))
            ->first();

        if (!$mainUser) $mainUser = new User();

        $mainUser->name = env('MAIN_USER_NAME');
        $mainUser->email = env('MAIN_USER_EMAIL');
        $mainUser->password = Hash::make(env('MAIN_USER_PASSWORD'));
        $mainUser->save();

        User::factory(10)->create();
    }
}

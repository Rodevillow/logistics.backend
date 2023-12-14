<?php

namespace Database\Seeders;

use App\Models\Storage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StorageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newStorage1 = new Storage;
        $newStorage1->address = '123 Main Street, Apt 4B, Cityville, State, 12345';
        $newStorage1->save();

        $newStorage2 = new Storage;
        $newStorage2->address = '234 Main Street, Apt 5B, Cityville, State, 23456';
        $newStorage2->save();

        $newStorage3 = new Storage;
        $newStorage3->address = '345 Main Street, Apt 6B, Cityville, State, 34567';
        $newStorage3->save();
    }
}

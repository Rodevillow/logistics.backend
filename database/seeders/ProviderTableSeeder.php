<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newProvider1 = new Provider;
        $newProvider1->name = 'Provider 1';
        $newProvider1->address = '456 Second Street, Apt 11A, Cityville, State, 11111';
        $newProvider1->save();

        $newProvider2 = new Provider;
        $newProvider2->name = 'Provider 2';
        $newProvider2->address = '567 Second Street, Apt 12B, Cityville, State, 22222';
        $newProvider2->save();

        $newProvider3 = new Provider;
        $newProvider3->name = 'Provider 3';
        $newProvider3->address = '678 Second Street, Apt 13V, Cityville, State, 33333';
        $newProvider3->save();
    }
}

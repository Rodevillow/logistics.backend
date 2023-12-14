<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Provider;
use App\Models\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = Provider::all();
        if (count($providers) < 3) return;
        $provider1Id = $providers[0]->id;
        $provider2Id = $providers[1]->id;
        $provider3Id = $providers[2]->id;

        $storages = Storage::all();
        if (count($storages) < 3) return;
        $storage1Id = $storages[0]->id;
        $storage2Id = $storages[1]->id;
        $storage3Id = $storages[2]->id;

        Product::factory()->count(5)->create(['provider_id' => $provider1Id, 'storage_id' => $storage1Id]);
        Product::factory()->count(5)->create(['provider_id' => $provider2Id, 'storage_id' => $storage1Id]);
        Product::factory()->count(5)->create(['provider_id' => $provider3Id, 'storage_id' => $storage1Id]);

        Product::factory()->count(5)->create(['provider_id' => $provider1Id, 'storage_id' => $storage2Id]);
        Product::factory()->count(5)->create(['provider_id' => $provider2Id, 'storage_id' => $storage2Id]);
        Product::factory()->count(5)->create(['provider_id' => $provider3Id, 'storage_id' => $storage2Id]);

        Product::factory()->count(5)->create(['provider_id' => $provider1Id, 'storage_id' => $storage3Id]);
        Product::factory()->count(5)->create(['provider_id' => $provider2Id, 'storage_id' => $storage3Id]);
        Product::factory()->count(5)->create(['provider_id' => $provider3Id, 'storage_id' => $storage3Id]);
    }
}

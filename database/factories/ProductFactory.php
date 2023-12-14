<?php

// database/factories/ProductFactory.php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            // You can access the parameters passed to the factory here
            $providerId = $this->parameters['provider_id'] ?? null;
            $storageId = $this->parameters['storage_id'] ?? null;

            // Now you can use $providerId and $storageId to set values in your model
            if ($providerId !== null) {
                $product->provider_id = $providerId;
            }

            if ($storageId !== null) {
                $product->storage_id = $storageId;
            }

            $product->save();
        });
    }
}

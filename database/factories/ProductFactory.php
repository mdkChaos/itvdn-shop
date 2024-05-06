<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->numerify('Product ###');
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraphs(4, true),
            'price' => fake()->randomFloat(2, 10, 999),
            'barcode' => fake()->ean8(),
            'stock' => fake()->numberBetween(0, 999),
            'cover' => 'https://loremflickr.com/640/480/computer'
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            $this->syncCategories($product);
        });
    }

    /**
     * Sync categories for the product.
     *
     * @param  Product  $product
     * @return void
     */
    protected function syncCategories(Product $product): void
    {
        $categories = [];

        for ($i = 0; $i < 4; $i++) {
            $categories[] = fake()->numberBetween(1, 5);
        }

        $product->categories()->sync($categories);
    }
}

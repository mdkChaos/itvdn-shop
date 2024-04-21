<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $photos = [
            '0' => 'https://loremflickr.com/640/480/computer',
            '1' => 'https://loremflickr.com/640/480/computer',
            '2' => 'https://loremflickr.com/640/480/computer',
            '3' => 'https://loremflickr.com/640/480/computer'
        ];

        return [
            'product_id' => null,
            'photos' => json_encode($photos)
        ];
    }
}

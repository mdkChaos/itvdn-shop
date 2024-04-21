<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Database\Seeder;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::all()->each(callback: function ($product){
           $gallery = Gallery::factory()->create();
           $product->gallery()->save($gallery);
        });
    }
}

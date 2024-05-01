<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::all()->each(function (Gallery $gallery) {
           $image = Image::factory(4)->create();
           $gallery->images()->saveMany($image);
        });
    }
}

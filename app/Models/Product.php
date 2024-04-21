<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    protected $fillable = ['title', 'slug', 'description', 'price', 'barcode', 'stock', 'cover'];

    public function gallery(): HasOne
    {
        return $this->hasOne(Gallery::class);
    }
}

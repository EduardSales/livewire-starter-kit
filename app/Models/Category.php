<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
   use HasFactory;

   protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getProducts(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    /**
     * Get the number of active products.
     */
    public function getActiveProductsCountAttribute(): int
    {
        return $this->hasMany(Product::class)->where('is_active', true)->count();
    }
    public static function getAllCategories()
    {
        return self::orderBy('name')->get();
    }
}
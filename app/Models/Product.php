<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description',
        'price',
        'stock',
        'category_id',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relació: un producte pertany a una categoria
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Scope per obtenir només productes actius
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor per formatar el preu
    public function getFormattedPriceAttribute(): string
    {
        return '€ ' . number_format($this->price, 2, '.', '');
    }
}

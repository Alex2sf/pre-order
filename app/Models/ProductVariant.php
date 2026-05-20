<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'name', 'price_adjustment', 'quota', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'product_id' => 'integer',
            'price_adjustment' => 'decimal:2',
            'quota' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Final price = base_price + price_adjustment
     */
    public function getFinalPriceAttribute(): float
    {
        return (float) $this->product->base_price + (float) $this->price_adjustment;
    }
}

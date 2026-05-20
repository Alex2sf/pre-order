<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id', 'name', 'description', 'base_price',
        'is_preorder', 'po_start_date', 'po_end_date',
        'estimated_delivery_days', 'estimated_delivery_date',
        'quota', 'min_dp_percent', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'tenant_id' => 'integer',
            'base_price' => 'decimal:2',
            'is_preorder' => 'boolean',
            'is_active' => 'boolean',
            'po_start_date' => 'datetime',
            'po_end_date' => 'datetime',
            'estimated_delivery_date' => 'date',
            'quota' => 'integer',
            'min_dp_percent' => 'integer',
            'estimated_delivery_days' => 'integer',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Check if PO is currently open for ordering.
     */
    public function getIsOpenAttribute(): bool
    {
        if (!$this->is_active) return false;

        // Always-open product
        if (!$this->is_preorder) return true;

        // Pre-order with time window
        $now = now();
        if ($this->po_start_date && $now->lt($this->po_start_date)) return false;
        if ($this->po_end_date && $now->gt($this->po_end_date)) return false;

        return true;
    }

    /**
     * Get total ordered quantity.
     */
    public function getTotalOrderedAttribute(): int
    {
        return (int) $this->orderItems()
            ->whereHas('order', fn($q) => $q->whereNotIn('status', ['cancelled']))
            ->sum('quantity');
    }

    /**
     * Get remaining quota.
     */
    public function getRemainingQuotaAttribute(): ?int
    {
        if (is_null($this->quota)) return null;
        return max(0, $this->quota - $this->total_ordered);
    }

    public function getStatusLabelAttribute(): string
    {
        if (!$this->is_active) return 'Nonaktif';
        if (!$this->is_open) return 'PO Tutup';
        if ($this->remaining_quota === 0) return 'Kuota Habis';
        return 'Buka';
    }
}

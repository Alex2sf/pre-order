<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id', 'invoice_number', 'customer_name', 'customer_phone', 'customer_address',
        'user_id', 'subtotal', 'total_amount', 'dp_amount', 'paid_amount',
        'payment_status', 'status', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'tenant_id' => 'integer',
            'subtotal' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'dp_amount' => 'decimal:2',
            'paid_amount' => 'decimal:2',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public static function generateInvoice(): string
    {
        $date = now()->format('Ymd');
        $latest = static::whereDate('created_at', today())->orderBy('id', 'desc')->first();
        $count = $latest ? ((int) substr($latest->invoice_number, -4)) + 1 : 1;
        return sprintf('PO-%s-%04d', $date, $count);
    }

    public function getRemainingAmountAttribute(): float
    {
        return max(0, (float) $this->total_amount - (float) $this->paid_amount);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'    => '⏳ Menunggu',
            'processing' => '⚙️ Diproses',
            'ready'      => '📦 Siap',
            'completed'  => '✅ Selesai',
            'cancelled'  => '❌ Batal',
            default      => $this->status,
        };
    }

    public function getPaymentStatusLabelAttribute(): string
    {
        return match ($this->payment_status) {
            'unpaid'  => '💤 Belum Bayar',
            'dp_paid' => '💳 DP Dibayar',
            'paid'    => '💰 Lunas',
            default   => $this->payment_status,
        };
    }
}

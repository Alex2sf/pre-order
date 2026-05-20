<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('base_price', 12, 2)->default(0);
            
            // PO Configuration
            $table->boolean('is_preorder')->default(true); // false = Always Open
            $table->dateTime('po_start_date')->nullable();
            $table->dateTime('po_end_date')->nullable();
            
            // Delivery/Fulfillment
            $table->integer('estimated_delivery_days')->nullable(); // e.g. takes 3 days to make
            $table->date('estimated_delivery_date')->nullable(); // specific date
            
            // Limit / Financials
            $table->integer('quota')->nullable(); // Null = unlimited
            $table->integer('min_dp_percent')->default(100); // 100 = full payment required, 50 = 50% DP
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

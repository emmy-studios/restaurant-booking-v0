<?php

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
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
        Schema::create('inventory_reports', function (Blueprint $table) {
            $table->id();
            $table->dateTime('report_date');
            $table->string('inventory_location')->nullable();
            $table->enum('currency_code', array_map(fn($code) => $code->value, CurrencyCode::cases()))->default('USD');
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('$');
            $table->decimal('total_stock_value', 10, 2);
            $table->integer('total_items_in_stock')->nullable();
            $table->integer('total_expired_items')->nullable();
            $table->integer('items_expiring_soon')->nullable();
            $table->text('most_used_items')->nullable();
            $table->text('least_used_items')->nullable();
            $table->decimal('total_used_items_value')->nullable();
            $table->text('restock_needed_items')->nullable();
            $table->text('stock_wastage')->nullable();
            $table->decimal('stock_wastage_value', 10, 2)->nullable();
            $table->dateTime('last_audit_date')->nullable();
            $table->dateTime('next_audit_date')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->text('report_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */ 
    public function down(): void
    {
        Schema::dropIfExists('inventory_reports');
    }
};

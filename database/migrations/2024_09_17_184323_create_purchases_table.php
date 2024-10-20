<?php

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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('total', 10, 2);
            $table->decimal('total_amount', 10, 2)->nullable(); 
            $table->dateTime('purchase_datetime')->nullable();
            $table->foreignId('purchase_supervisor')->constrained('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

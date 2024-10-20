<?php

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Enums\UnitOfMeasurement;
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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('product_name')->nullable();
            $table->enum('unit_of_measurement', array_map(fn($code) => $code->value, UnitOfMeasurement::cases()))->default('Unit'); 
            $table->decimal('quantity', 10, 2)->nullable();
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('discount_percentage', 10, 2)->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};

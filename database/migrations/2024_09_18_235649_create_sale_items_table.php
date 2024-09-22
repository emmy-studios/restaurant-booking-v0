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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('discount_percentage', 10, 2);
            $table->enum('unit_of_measurement', array_map(fn($code) => $code->value, UnitOfMeasurement::cases()))->default('Unit');
            $table->integer('quantity')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable(); 
            $table->enum('currency_code', array_map(fn($code) => $code->value, CurrencyCode::cases()))->default('USD');
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};

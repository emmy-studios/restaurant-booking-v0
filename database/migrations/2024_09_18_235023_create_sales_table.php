<?php

use App\Enums\CountryCode;
use App\Enums\CurrencySymbol;
use App\Enums\SaleSource;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_code');
            $table->foreignId('employee_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->enum('phone_code', array_map(fn($code) => $code->value, CountryCode::cases()))->nullable();
            $table->string('customer_phone_number')->nullable();
            $table->enum('sale_source', array_map(fn($code) => $code->value, SaleSource::cases()))->default('Online');
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
        Schema::dropIfExists('sales');
    }
};

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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_code');
            $table->decimal('discount_percentage' ,10,2);
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('banner_text')->nullable();
            $table->string('banner_image')->nullable();
            $table->text('description')->nullable();
            $table->text('additional_details')->nullable();
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};

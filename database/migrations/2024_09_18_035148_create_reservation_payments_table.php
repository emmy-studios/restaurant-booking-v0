<?php

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
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
        Schema::create('reservation_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('payment_method', array_map(fn($code) => $code->value, PaymentMethod::cases()))->default('Credit Card');
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('payment_amount', 10, 2);
            $table->enum('payment_status', array_map(fn($code) => $code->value, PaymentStatus::cases()))->default('Completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_payments');
    }
};

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
        Schema::create('event_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('payment_method', array_map(fn($code) => $code->value, PaymentMethod::cases()))->default('Cash');
            $table->enum('payment_status', array_map(fn($code) => $code->value, PaymentStatus::cases()))->default('Pending');
            $table->enum('currency_code', array_map(fn($code) => $code->value, CurrencyCode::cases()))->default('USD');
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('payment_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_payments');
    }
};

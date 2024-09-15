<?php

use App\Enums\BillingStatus;
use App\Enums\PaymentCurrency;
use App\Enums\PaymentMethod;
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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('billing_code');
            $table->enum('payment_method', array_map(fn($code) => $code->value, PaymentMethod::cases()))->default('Credit Card');
            $table->enum('payment_currency', array_map(fn($code) => $code->value, PaymentCurrency::cases()))->default('USD');
            $table->enum('status', array_map(fn($code) => $code->value, BillingStatus::cases()))->default('Processing');
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
        Schema::dropIfExists('billings');
    }
};
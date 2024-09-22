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
        Schema::create('daily_sale_reports', function (Blueprint $table) {
            $table->id();
            $table->dateTime('report_date');

            $table->integer('total_orders')->nullable();
            $table->integer('total_sales')->nullable();
            $table->enum('currency_code', array_map(fn($code) => $code->value, CurrencyCode::cases()))->default('USD');
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->integer('total_discounts')->nullable();
            $table->decimal('total_net_amount')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_sale_reports');
    }
};

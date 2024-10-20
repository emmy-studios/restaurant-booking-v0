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
        Schema::create('daily_sale_reports', function (Blueprint $table) {
            $table->id();
            $table->dateTime('report_date');
            $table->integer('total_orders')->nullable();
            $table->integer('total_sales')->nullable();
            $table->enum('sales_currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('sales_subtotal', 10, 2)->default(0);
            $table->integer('sales_discounts_applied')->nullable();
            $table->decimal('discount_total_amount', 10, 2)->nullable();
            $table->decimal('total_net_amount')->default(0);
            $table->text('details')->nullable();
            $table->text('notes')->nullable();
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

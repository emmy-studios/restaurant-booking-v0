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
        Schema::create('event_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->text('additional_details')->nullable();
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('service_price', 10, 2)->nullable();
            $table->decimal('additional_cost', 10, 2)->nullable();
            $table->text('additional_cost_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_services');
    }
};

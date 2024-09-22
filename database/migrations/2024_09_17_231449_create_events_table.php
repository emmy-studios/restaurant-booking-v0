<?php

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Enums\EventStatus;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id(); 
            $table->string('event_code');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('event_name');
            $table->dateTime('event_date')->nullable();
            $table->integer('number_of_guests');
            $table->text('event_description')->nullable();
            $table->enum('event_status', array_map(fn($code) => $code->value, EventStatus::cases()))->default('Confirmed');
            $table->enum('currency_code', array_map(fn($code) => $code->value, CurrencyCode::cases()))->default('USD');
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('subtotal_cost', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

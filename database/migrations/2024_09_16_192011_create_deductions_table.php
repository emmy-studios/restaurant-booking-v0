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
        Schema::create('deductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('currency_code', array_map(fn($code) => $code->value, CurrencyCode::cases()))->default('USD');
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('amount', 10, 2);
            $table->string('type')->nullable();
            $table->text('description')->nullable(); 
            $table->date('date_applied')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deductions');
    }
};

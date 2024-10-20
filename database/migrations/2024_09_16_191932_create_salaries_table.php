<?php

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Enums\SalaryType;
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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('employee_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('currency_symbol', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('base_salary', 10, 2);
            $table->decimal('net_salary', 10, 2);
            $table->enum('salary_type', array_map(fn($code) => $code->value, SalaryType::cases()))->default('Monthly');
            $table->dateTime('effective_date')->nullable(); 
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};

<?php

use App\Enums\CurrencySymbol;
use App\Enums\OvertimeStatus;
use App\Enums\OvertimeType;
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
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->date('overtime_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('number_of_hours');
            $table->text('reason')->nullable();
            $table->enum('status', array_map(fn($code) => $code->value, OvertimeStatus::cases()))->default('Pending');
            $table->enum('overtime_type', array_map(fn($code) => $code->value, OvertimeType::cases()))->default('Daytime');
            $table->foreignId('approved_by')->constrained('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('payment_method', array_map(fn($code) => $code->value, PaymentMethod::cases()))->default('Credit Card');
            $table->enum('payment_currency', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->decimal('total_payment', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};

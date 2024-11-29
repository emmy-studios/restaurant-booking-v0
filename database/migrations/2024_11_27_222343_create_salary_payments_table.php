<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\SalaryType;
use App\Enums\CurrencySymbol;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\EmployeeConfirmation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salary_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('payment_code')->unique();
            $table->date('payment_date');
            $table->enum('salary_type', array_map(fn($code) => $code->value, SalaryType::cases()))->default('Monthly');
            $table->enum('payment_method', array_map(fn($code) => $code->value, PaymentMethod::cases()))->default('Bank Transfer');
            $table->enum('currency', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('base_salary', 10, 2);
            $table->decimal('overtime_payment', 10, 2)->nullable();
            $table->decimal('bonus_payment', 10, 2)->nullable();
            $table->decimal('tax_deductions', 10, 2)->nullable();
            $table->decimal('insurance_deductions', 10, 2)->nullable();
            $table->decimal('other_deductions', 10, 2)->nullable();
            $table->decimal('deductions_total', 10, 2)->nullable();
            $table->decimal('net_salary', 10, 2);
            $table->decimal('total_overtime_hours', 10, 2)->nullable();
            $table->integer('total_absences')->nullable();
            $table->decimal('total_hours_worked', 8, 2)->nullable();
            $table->enum('payment_status', array_map(fn($code) => $code->value, PaymentStatus::cases()))->default('Pending');
            $table->enum('employee_confirmation', array_map(fn($code) => $code->value, EmployeeConfirmation::cases()))->default('Pending');
            $table->foreignId('approved_by')->nullable()->constrained('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->text('approver_comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_payments');
    }
};

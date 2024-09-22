<?php

use App\Enums\AccountType;
use App\Enums\ContractType;
use App\Enums\Countries;
use App\Enums\CountryCode;
use App\Enums\EmployeeStatus;
use App\Enums\PaymentCurrency;
use App\Enums\Roles;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('postal_code')->nullable();
            $table->enum('phone_code', array_map(fn($code) => $code->value, CountryCode::cases()))->default('+506');
            $table->string('phone_number')->nullable();
            $table->enum('country', array_map(fn($code) => $code->value, Countries::cases()))->default('Costa Rica');
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('hire_date')->nullable();
            $table->string('social_security_number')->nullable();
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->enum('contract_type', array_map(fn($code) => $code->value, ContractType::cases()))->default('Permanent');
            $table->string('secondary_email')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('id_number')->nullable();
            $table->boolean('work_permit')->default(false);
            $table->string('tax_id_number')->nullable();
            $table->enum('status', array_map(fn($code) => $code->value, EmployeeStatus::cases()))->default('Active');
            $table->string('supervisor')->nullable();
            $table->date('fire_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->date('last_promotion_date')->nullable();
            $table->date('last_promotion_role')->nullable();
            $table->enum('role', array_map(fn($code) => $code->value, Roles::cases()))->default('Employee');
            $table->string('bank_name')->nullable(); 
            $table->string('account_number')->nullable();
            $table->enum('account_type', array_map(fn($code) => $code->value, AccountType::cases()))->default('Checking');
            $table->string('bank_code')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('iban')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

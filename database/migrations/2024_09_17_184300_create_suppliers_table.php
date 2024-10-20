<?php

use App\Enums\Countries;
use App\Enums\CountryCode;
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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('company_name')->nullable(); 
            $table->enum('phone_code', array_map(fn($code) => $code->value, CountryCode::cases()))->default('+506');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->enum('country', array_map(fn($code) => $code->value, Countries::cases()))->default('Costa Rica');
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};

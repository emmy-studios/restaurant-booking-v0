<?php

use App\Enums\Countries;
use App\Enums\CountryCode;
use App\Enums\Gender;
use App\Enums\Roles;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\text;

return new class extends Migration
{
    /**
     * Run the migrations. 
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('identification_code')->nullable()->unique();
            $table->string('email')->unique();
            $table->enum('gender', array_map(fn($code) => $code->value, Gender::cases()))->default('Other');
            $table->string('image_url')->nullable();
            $table->enum('country_code', array_map(fn($code) => $code->value, CountryCode::cases()))->default('+506');
            $table->string('phone_number')->nullable();
            $table->enum('country', array_map(fn($code) => $code->value, Countries::cases()))->default('Costa Rica');
            $table->string('city')->nullable(); 
            $table->string('postal_code')->nullable();
            $table->text('address')->nullable();
            $table->enum('role', array_map(fn($code) => $code->value, Roles::cases()))->default('CUSTOMER');
            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

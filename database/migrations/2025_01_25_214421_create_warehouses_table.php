<?php

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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_code')->unique();
            $table->string('warehouse_name');
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->text('other_signs')->nullable();
            $table->string('minimum_capacity')->nullable();
            $table->string('maximum_capacity')->nullable();
            $table->string('current_capacity')->nullable();
            $table->boolean('temperature_controlled')->default(false);
            $table->string('temperature_range')->nullable();
            $table->enum('audit_frequency');
            $table->dateTime('last_audit_date')->nullable();
            $table->dateTime('next_audit_date')->nullable();
            $table->text('additional_details')->nullable();
            $table->string('supervisor_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};

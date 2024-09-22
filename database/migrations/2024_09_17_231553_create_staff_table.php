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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('role')->nullable();
            $table->dateTime('shift_start')->nullable();
            $table->dateTime('shift_end')->nullable();
            $table->dateTime('check_in_time')->nullable();
            $table->dateTime('check_out_time')->nullable();
            $table->integer('hours_worked')->nullable();
            $table->boolean('need_uniform')->default(false);
            $table->text('meal_preferences')->nullable();
            $table->boolean('transport_provided')->default(false);
            $table->boolean('training_required')->default(false);
            $table->boolean('training_completed')->default(false);
            $table->text('location_assigned')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};

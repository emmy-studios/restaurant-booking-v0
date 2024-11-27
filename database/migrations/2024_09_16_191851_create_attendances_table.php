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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->date('date')->nullable();
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->decimal('total_work_hours', 5, 2)->nullable();
            $table->time('break_start_time')->nullable();
            $table->time('break_end_time')->nullable();
            $table->decimal('lunch_break_duration', 4, 2)->nullable();
            $table->boolean('is_holiday')->default(false);
            $table->boolean('is_weekend')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

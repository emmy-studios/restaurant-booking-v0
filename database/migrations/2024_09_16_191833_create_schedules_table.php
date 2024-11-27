<?php

use App\Enums\WorkShift;
use App\Enums\WorkType;
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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->time('shift_start_time')->nullable();
            $table->time('shift_end_time')->nullable();
            $table->enum('work_shift', array_map(fn($code) => $code->value, WorkShift::cases()))->default('Morning');
            $table->enum('work_type', array_map(fn($code) => $code->value, WorkType::cases()))->default('On-site');
            $table->boolean('is_recurring')->default(true);
            $table->date('schedule_start_date')->nullable();
            $table->date('schedule_end_date')->nullable();
            $table->date('modified_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};

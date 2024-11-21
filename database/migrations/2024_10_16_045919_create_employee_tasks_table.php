<?php

use App\Enums\TaskStatus;
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
        Schema::create('employee_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('task_name');
            $table->text('description');
            $table->text('additional_details')->nullable();
            $table->enum('status', array_map(fn($status) => $status->value, TaskStatus::cases()))->default('Pending');
            $table->dateTime('due_date')->nullable();
            $table->boolean('is_read')->default(false);
            $table->foreignId('supervisor_id')->nullable()->constrained('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->text('supervisor_comment')->nullable();
            $table->text('employee_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_tasks');
    }
};

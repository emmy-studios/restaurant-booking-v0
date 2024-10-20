<?php

use App\Enums\AbsenceType;
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
        Schema::create('absences', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('employee_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('justified')->default(false);
            $table->text('reason')->nullable();
            $table->text('details')->nullable();
            $table->enum('absence_type', array_map(fn($code) => $code->value, AbsenceType::cases()))->default('Illness');
            $table->foreignId('approved_by')->constrained('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};

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
        Schema::create('inventory_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('audited_value', 10, 2)->nullable(); 
            $table->integer('audited_quantity')->nullable(); 
            $table->string('audited_by')->nullable(); 
            $table->dateTime('audit_date'); 
            $table->text('remarks')->nullable(); 
            $table->text('additional_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_audits');
    }
};

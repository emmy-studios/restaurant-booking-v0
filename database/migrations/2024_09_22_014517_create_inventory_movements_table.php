<?php

use App\Enums\InventoryMovementType;
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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('inventory_item_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('movement_type', array_map(fn($code) => $code->value, InventoryMovementType::cases()));
            $table->decimal('quantity', 10, 2);
            $table->decimal('previous_quantity', 10, 2)->nullable(); 
            $table->decimal('new_quantity', 10, 2)->nullable(); 
            $table->text('reason')->nullable();  
            $table->foreignId('employee_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); // Usuario que realizó el movimiento
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};

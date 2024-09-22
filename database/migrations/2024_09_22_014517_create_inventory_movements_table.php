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
            $table->decimal('previous_quantity', 10, 2)->nullable(); // Para almacenar la cantidad anterior
            $table->decimal('new_quantity', 10, 2)->nullable(); // Para almacenar la cantidad después del movimiento
            $table->text('reason')->nullable(); // Razón del movimiento
            $table->string('performed_by')->nullable(); // Usuario que realizó el movimiento
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

<?php

use App\Enums\CurrencyCode;
use App\Enums\InventoryStatus;
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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id(); 
            $table->decimal('total_quantity', 10, 2)->default(0);
            $table->dateTime('last_restocked_at')->nullable();
            $table->dateTime('next_restock_date')->nullable();
            $table->string('warehouse_location')->nullable(); 
            $table->text('storage_conditions')->nullable();
            $table->enum('currency', array_map(fn($code) => $code->value, CurrencyCode::cases()))->default('USD');
            $table->decimal('inventory_value', 10, 2)->nullable();
            $table->decimal('holding_cost', 10, 2)->nullable();
            $table->decimal('cost_of_goods_sold', 10, 2)->nullable();
            $table->dateTime('last_audit_date')->nullable();
            $table->dateTime('next_audit_date')->nullable(); 
            $table->enum('inventory_status', array_map(fn($code) => $code->value, InventoryStatus::cases()))->default('Active');
            $table->string('inventory_manager')->nullable(); 
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};

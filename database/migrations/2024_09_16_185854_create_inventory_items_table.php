<?php

use App\Enums\UnitOfMeasurement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CurrencySymbol;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('name');
            $table->string('description');
            $table->string('image_url')->nullable();
            $table->boolean('perishable_product')->default(false);
            $table->dateTime('expiration_date')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('rack')->nullable();
            $table->string('additional_location_information')->nullable();
            $table->enum('unit_of_measurement', array_map(fn($code) => $code->value, UnitOfMeasurement::cases()))->default('Unit');
            $table->decimal('quantity', 10, 2)->nullable();
            $table->enum('currency', array_map(fn($code) => $code->value, CurrencySymbol::cases()))->default('USD $');
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('storage_costs', 10, 2)->nullable();
            $table->decimal('maintenance_costs', 10, 2)->nullable();
            $table->decimal('replenishment_costs')->nullable();
            $table->dateTime('last_replenishment')->nullable();
            $table->dateTime('last_maintenance')->nullable();
            $table->dateTime('next_replenishment')->nullable();
            $table->dateTime('next_maintenance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};

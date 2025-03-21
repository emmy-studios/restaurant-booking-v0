<?php

use App\Enums\UnitOfMeasurement;
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
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('unit_of_measurement', array_map(fn($code) => $code->value, UnitOfMeasurement::cases()))->default('Unit');
            $table->decimal('quantity', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_recipe');
    }
};

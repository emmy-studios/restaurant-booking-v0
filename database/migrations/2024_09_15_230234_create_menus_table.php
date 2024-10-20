<?php

use App\Enums\MenuStatus;
use App\Enums\MenuType;
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
        Schema::create('menus', function (Blueprint $table) {
            $table->id(); 
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('menu_code')->nullable();
            $table->enum('menu_status', array_map(fn($code) => $code->value, MenuStatus::cases()))->default('Active');
            $table->enum('menu_type', array_map(fn($code) => $code->value, MenuType::cases()))->default('Special');
            $table->boolean('is_recurring')->nullable();
            $table->dateTime('initial_date')->nullable();
            $table->dateTime('final_date')->nullable(); 
            $table->string('menu_availability')->nullable();
            $table->string('portions');
            $table->timestamps(); 
        });
    }

    /** 
     * Reverse the migrations.
     */ 
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};

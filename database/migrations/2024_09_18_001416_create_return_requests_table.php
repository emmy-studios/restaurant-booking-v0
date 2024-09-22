<?php

use App\Enums\ReturnStatus;
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
        Schema::create('return_requests', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->string('product_name');
            $table->string('customer_name');
            $table->string('responsable_employee');
            $table->dateTime('request_date');
            $table->integer('quantity');
            $table->text('reason');
            $table->enum('status', array_map(fn($code) => $code->value, ReturnStatus::cases()))->default('Processing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_requests');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Roles;
use App\Enums\NotificationType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('role', array_map(fn($code) => $code->value, Roles::cases()))->default('Customer');
            $table->string('title');
            $table->text('message');
            $table->enum('notification_type', array_map(fn($code) => $code->value, NotificationType::cases()))->default('Information');
            $table->boolean('is_read')->default(false);
            $table->json('data')->nullable();
            $table->string('redirect_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

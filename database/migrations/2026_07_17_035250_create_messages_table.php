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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // ID del usuario que envia el mensaje
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');

            // ID del usuario que recibe el mensaje
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');

            // Contenido del mensaje
            $table->text('content');
            
            $table->timestamps();

            // Indices para optimizar busquedas de conversaciones
            $table->index(['sender_id', 'receiver_id']);
            $table->index(['receiver_id', 'sender_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};

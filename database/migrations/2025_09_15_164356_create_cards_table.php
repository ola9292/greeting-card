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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('message');
            $table->string('sender_name');
            $table->string('recipient_name');
            $table->string('occasion');

            // Foreign keys
            $table->foreignId('background_id')
                  ->constrained('backgrounds')
                  ->onDelete('cascade');

            $table->foreignId('song_id')
                  ->constrained('songs')
                  ->onDelete('cascade');

            // Unique slug for shareable link
            $table->string('slug')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};

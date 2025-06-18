<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_id')->unique();
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->string('game_url')->nullable();
            $table->string('genre')->nullable();
            $table->string('platform')->nullable();
            $table->string('publisher')->nullable();
            $table->string('developer')->nullable();
            $table->string('release_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};

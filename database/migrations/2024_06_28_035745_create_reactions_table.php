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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->string('type_reaction');
            $table->unsignedBiginteger('profile_id');
            $table->unsignedBigInteger('post_id')->nullable();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};

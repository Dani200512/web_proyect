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
            $table->string('content');
            $table->string('state');
            $table->unsignedBigInteger('id_profile1');
            $table->unsignedBigInteger('id_profile2');
            $table->foreign('id_profile1')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('id_profile2')->references('id')->on('profiles')->onDelete('cascade');
            $table->timestamps();
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

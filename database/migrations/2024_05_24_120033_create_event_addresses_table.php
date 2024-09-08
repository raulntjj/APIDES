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
        Schema::create('event_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->string('address', 128)->nullable();
            $table->integer('number')->nullable();
            $table->string('neighborhood', 64)->nullable();
            $table->string('city', 32)->nullable();
            $table->string('state', 32)->nullable();
            $table->string('country', 32)->nullable();
            $table->string('cep', 16)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_addresses');
    }
};

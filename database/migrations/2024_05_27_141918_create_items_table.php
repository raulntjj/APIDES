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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_criterion_id');
            $table->foreign('sub_criterion_id')->references('id')->on('sub_criteria')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 64);
            $table->enum('aspect', ['measurable', 'subjective']);
            $table->decimal('weight', 4, 2)->nullable(); // Permitindo valores de 0.01 a 10.00
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

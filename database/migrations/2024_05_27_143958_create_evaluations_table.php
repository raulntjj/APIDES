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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('modality_id');
            $table->foreign('modality_id')->references('id')->on('modalities')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('criterion_id');
            $table->foreign('criterion_id')->references('id')->on('criteria')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('sub_criterion_id');
            $table->foreign('sub_criterion_id')->references('id')->on('sub_criteria')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('judgment_id')->nullable();
            $table->foreign('judgment_id')->references('id')->on('judgments')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliations');
    }
};

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
            $table->unsignedBigInteger('participant_id')->nullable();

            $table->unsignedBigInteger('judge_id')->nullable();
            $table->foreign('judge_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('eventDay_id')->nullable();
            $table->foreign('eventDay_id')->references('id')->on('event_days')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('modality_id');
            $table->foreign('modality_id')->references('id')->on('modalities')->onDelete('cascade')->onUpdate('cascade');

            $table->date('date')->nullable();
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

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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_criterion_id');
            $table->foreign('sub_criterion_id')->references('id')->on('sub_criteria')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('judge_id');
            $table->foreign('judge_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};

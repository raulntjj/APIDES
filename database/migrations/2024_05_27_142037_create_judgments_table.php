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
        Schema::create('judgments', function (Blueprint $table) {
            $table->id(); //Exemple Id: 1
            $table->unsignedBigInteger('item_id'); // Exemple:  item_id: 1 ["Physic, 100 points, measurable"]
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->string('aspect'); //Exemple: aspect: jugdment
            $table->json('scores'); //Exemple: {"score1": "power", "score2" : "resistence", "score3" : "speed"}
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugdments');
    }
};

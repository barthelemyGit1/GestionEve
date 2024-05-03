<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('souscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personnel_id')->nullable();
            $table->string('modePayement');
            $table->string('dateDebut');
            $table->string('dateFin');
            $table->string('email');
            $table->integer('montantTotal');
            $table->integer('montantPayé')->default(0);
            $table->integer('montantRestant');
            $table->string('typeProduit');
            $table->string('site');
            $table->string('typeLogement');
            $table->integer('superficieLogement');
            $table ->foreign('personnel_id')->references('id')->on('Personnels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('souscriptions');
    }
};

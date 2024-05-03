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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('matricule')->default('neant');
            $table->string('nom');
            $table->string('prenom');
            $table->string('dateNaiss');
            $table->string('tel');
            $table->string('cnib');
            $table->string('service');
            $table->string('email')->unique()->default('');
            $table->integer('salaire')->default(0);
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
        Schema::dropIfExists('personnels');
    }
};

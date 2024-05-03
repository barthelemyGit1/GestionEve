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
        Schema::create('Activite', function (Blueprint $table) {
            $table->id();
            $table->string('objet');
            $table->string('resultattendu');
            $table->double('cout');
            $table->string('indicateur');
            $table->string('periode');
            $table->string('contraints');
            $table->string('structure');
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
        Schema::dropIfExists('Activite');
    }
};

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
        Schema::create('Exemption', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membre_id')->nullable();
            $table->string('motif');
            $table->string('nbrMois');
            $table->date('anneeExempt');
            $table->date('startexcempt');
            $table->date('endexempt');
            $table ->foreign('membre_id')->references('id')->on('Membre')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::disableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Exemption');
    }
};

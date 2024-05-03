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
        Schema::create('Histocotisation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id')->nullable();
            $table ->foreign('categorie_id')->references('id')->on('Categorie')->onDelete('cascade');
            $table->double('montant');
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
        Schema::dropIfExists('HistoCotisation');
    }
};

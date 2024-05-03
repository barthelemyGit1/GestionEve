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
        Schema::create('ReglementCoti', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('membre_id')->nullable();
            $table->unsignedBigInteger('categorie_id')->nullable();
            $table ->foreign('membre_id')->references('id')->on('Membre')->onDelete('cascade');
            $table->double('montant');
            $table->date('pour_le_mois');
            $table ->foreign('categorie_id')->references('id')->on('Categorie')->onDelete('cascade');
       
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
        Schema::dropIfExists('ReglementCoti');
    }
};

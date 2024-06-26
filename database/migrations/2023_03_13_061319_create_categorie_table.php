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
        Schema::create('Categorie', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->double('taux');
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
        Schema::dropIfExists('Categorie');
    }
};

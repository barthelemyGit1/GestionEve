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
        Schema::create('Membre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personnel_id')->nullable()->unique();
            $table->unsignedBigInteger('categorie_id')->nullable();
            $table->string('Email');
            $table->date('dateadhession');
            $table ->foreign('personnel_id')->references('id')->on('Personnels')->onDelete('cascade');
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
        Schema::dropIfExists('Membre');
    }
};

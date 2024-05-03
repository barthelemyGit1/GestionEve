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
        Schema::create('Parcelles', function (Blueprint $table) {
            $table->id()->nullable();
            $table->unsignedBigInteger('souscription_id')->nullable();
            $table->string('nature');
            $table->string('site');//->unique();
            $table->double('superficie');
            $table->double('superficieattribuee');
            $table->string('nature_2');
            $table->double('section');
            $table->double('lot');
            $table->double('numvilla');
            $table ->foreign('souscription_id')->references('id')->on('souscriptions')->onDelete('cascade');

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
        Schema::dropIfExists('Parcelles');
    }
};

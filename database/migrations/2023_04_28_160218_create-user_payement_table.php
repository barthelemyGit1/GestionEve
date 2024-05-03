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
        Schema::create('users_payement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('souscription_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('numeroRecu');
            $table->string('datePayBanq');
            $table->integer('montant');
            $table->string('image')->nullable()->default('none');
            $table->string('statut')->default('En cours...');
            $table->foreign('souscription_id')->references('id')->on('souscriptions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
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
        Schema::dropIfExists('users_payement');
    }
};

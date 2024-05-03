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
        Schema::create('Activite_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Activite__type_id')->nullable();
            $table->string('type_activite');
            $table->double('particitpants')->nullable()->default(0);
            $table->json('champvalues');
            $table ->foreign('Activite__type_id')->references('id')->on('Activite_type')->onDelete('cascade');

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
        Schema::dropIfExists('Activite_detail');
    }
};

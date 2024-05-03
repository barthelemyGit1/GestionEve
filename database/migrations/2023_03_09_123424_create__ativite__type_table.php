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
        Schema::create('Activite_type', function (Blueprint $table) {
            $table->id()->nullable();
            $table->string('type_activite')->unique();
            $table->json('caracteristic');
            $table->json('typedonne');
            $table->double('items')->nullable()->default(0);
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
        Schema::dropIfExists('Activite_type');
    }
};

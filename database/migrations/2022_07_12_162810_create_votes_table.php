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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('survey_id');
            $table->timestamps();
        });

        Schema::table('votes', function (Blueprint $table) {
            $table->foreign('option_id')->references('id')->on('options')->cascadeOnDelete();
            $table->foreign('survey_id')->references('id')->on('surveys')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
};

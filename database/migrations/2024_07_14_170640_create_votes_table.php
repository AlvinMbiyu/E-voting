<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('voters_id');
            $table->integer('candidate_id');
            $table->integer('position_id');

            $table->primary('id');
            $table->foreign('voters_id')->references('id')->on('voters');
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('position_id')->references('id')->on('positions');
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
}

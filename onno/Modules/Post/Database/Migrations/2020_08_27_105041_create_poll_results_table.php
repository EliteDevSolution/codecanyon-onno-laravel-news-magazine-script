<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('poll_id')->nullable();
            $table->unsignedBigInteger('poll_option_id')->nullable();
            $table->foreign('poll_option_id')->references('id')->on('poll_options')->onDelete('cascade');
            $table->string('browser_details')->nullable();
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
        Schema::dropIfExists('poll_results');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cron_for');
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();
            $table->bigInteger('video_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('video_id')->references('id')->on('videos')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crons');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('video_name'); 
            $table->text('video_thumbnail');
            $table->string('disk');
            $table->text('original');
            $table->text('v_144p')->nullable();
            $table->text('v_240p')->nullable();
            $table->text('v_360p')->nullable();
            $table->text('v_480p')->nullable(); 
            $table->text('v_720p')->nullable();
            $table->text('v_1080p')->nullable(); 
            $table->string('video_type')->nullable(); 
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
        Schema::dropIfExists('videos');
    }
}

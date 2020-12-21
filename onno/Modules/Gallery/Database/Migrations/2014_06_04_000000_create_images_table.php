<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('disk');
            $table->string('original_image');
            $table->string('og_image');
            $table->string('thumbnail');
            $table->string('big_image');
            $table->string('big_image_two');
            $table->string('medium_image');
            $table->string('medium_image_two');
            $table->string('medium_image_three');
            $table->string('small_image');
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
        Schema::dropIfExists('images');
    }
}

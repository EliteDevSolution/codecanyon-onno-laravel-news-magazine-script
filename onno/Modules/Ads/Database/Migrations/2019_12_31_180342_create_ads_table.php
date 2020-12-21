<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ad_name')->nullable();
            $table->string('ad_size')->nullable();
            $table->string('ad_type')->nullable();
            $table->string('ad_url')->nullable();
            $table->bigInteger('ad_image_id')->unsigned()->nullable();
            $table->longText('ad_code')->nullable();
            $table->longText('ad_text')->nullable();
            $table->timestamps();

            $table->foreign('ad_image_id')->references('id')->on('images')
                ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}

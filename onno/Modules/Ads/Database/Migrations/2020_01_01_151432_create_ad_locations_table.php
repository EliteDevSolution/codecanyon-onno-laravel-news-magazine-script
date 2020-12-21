<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('unique_name')->unique();
            $table->bigInteger('ad_id')->unsigned()->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('ad_id')->references('id')->on('ads')
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
        Schema::dropIfExists('ad_locations');
    }
}

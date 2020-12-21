<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('unique_name')->unique();
            $table->bigInteger('menu_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menu')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_locations');
    }
}

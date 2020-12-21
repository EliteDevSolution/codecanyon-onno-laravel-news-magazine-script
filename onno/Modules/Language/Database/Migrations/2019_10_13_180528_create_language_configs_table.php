<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('language_id')->unsigned();
            $table->string('name');
            $table->string('script')->nullable();
            $table->string('native')->nullable();
            $table->string('regional')->nullable();

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
        
        Schema::dropIfExists('language_configs');
        
    }
}

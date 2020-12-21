<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_trackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('page_type')->nullable()->comment('1, home page, 2 post details, 3 page detail');
            $table->string('slug')->nullable();
            $table->string('url')->nullable();
            $table->string('source_url')->nullable();
            $table->string('ip')->nullable();
            $table->string('agent_browser')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('visitor_trackers');
    }
}

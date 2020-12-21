<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('language')->default('en');
            $table->longText('content')->nullable();
            $table->string('short_code')->unique()->nullable();
            $table->integer('order')->unsigned()->default(1);
            $table->integer('location')->default(\Modules\Widget\Enums\WidgetLocation::RIGHT_SIDEBAR);
            $table->integer('content_type')->default(\Modules\Widget\Enums\WidgetContentType::POPULAR_POST);
            $table->boolean('status')->default(1);
            $table->boolean('is_custom')->default(1);

            $table->bigInteger('ad_id')->nullable()->unsigned()->default(null);
            $table->foreign('ad_id')->references('id')->on('ads')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('widgets');
    }
}

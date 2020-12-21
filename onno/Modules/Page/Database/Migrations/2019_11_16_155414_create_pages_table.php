<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('image_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('language');
            $table->boolean('page_type')->default(1)->comment('1 default page, 2 contact us page');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('template')->default(1)->comment('1 without sidebar, 2 with right sidebar, 3 with left sidebar');
            $table->string('visibility');
            $table->boolean('show_for_register');
            $table->boolean('show_title');
            $table->boolean('show_breadcrumb');
            $table->string('location')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();

            $table->foreign('image_id')->references('id')->on('images')
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
        Schema::dropIfExists('pages');
    }
}

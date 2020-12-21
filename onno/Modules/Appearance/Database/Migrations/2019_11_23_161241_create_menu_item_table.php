<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->string('language');
            $table->bigInteger('menu_id')->unsigned();
            $table->enum('is_mega_menu', ['no', 'tab', 'category'])->comment('no = normal menu, tab = tab type mega menu, category = category type mega menu');
            $table->integer('order')->default(0);
            $table->bigInteger('parent')->nullable()->unsigned()->default(null);
            $table->string('source');
            $table->string('url')->nullable();
            $table->bigInteger('page_id')->nullable()->unsigned()->default(null);
            $table->bigInteger('category_id')->nullable()->unsigned()->default(null);
            $table->unsignedBigInteger('post_id')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('new_teb')->default(0);
            $table->timestamps();

            $table->foreign('parent')->references('id')->on('menu_item')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('menu_id')->references('id')->on('menu')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('page_id')->references('id')->on('pages')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('post_id')->references('id')->on('posts')
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
        Schema::dropIfExists('menu_item');
    }
}

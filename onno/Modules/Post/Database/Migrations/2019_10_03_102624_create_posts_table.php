<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->string('language');

            $table->integer('user_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('sub_category_id')->unsigned()->nullable();
            $table->enum('post_type', ['article', 'video', 'audio'])->default('article');

            $table->boolean('submitted')->default(0)->comment('0 Non Submitted, 1 submitted');

            $table->bigInteger('image_id')->unsigned()->nullable();
            $table->boolean('visibility')->default(0);
            $table->boolean('auth_required')->default(0);
            $table->boolean('slider')->default(0);
            $table->integer('slider_order')->default(0);
            $table->boolean('featured')->default(0);
            $table->integer('featured_order')->default(0);
            $table->boolean('breaking')->default(0);
            $table->integer('breaking_order')->default(0);
            $table->boolean('recommended')->default(0);
            $table->integer('recommended_order')->default(0);
            $table->boolean('editor_picks')->default(0);
            $table->integer('editor_picks_order')->default(0);
            $table->boolean('scheduled')->default(0);

            $table->text('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('tags')->nullable();
            $table->timestamp('scheduled_date')->nullable();
            $table->string('layout')->default('default');

            $table->bigInteger('video_id')->unsigned()->nullable();
            $table->string('video_url_type')->nullable();
            $table->text('video_url')->nullable();
            $table->bigInteger('video_thumbnail_id')->unsigned()->nullable();

            $table->boolean('status')->default(0);
            $table->bigInteger('total_hit')->default(0);

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('sub_category_id')->references('id')->on('sub_categories')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('image_id')->references('id')->on('images')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('video_thumbnail_id')->references('id')->on('images')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('video_id')->references('id')->on('videos')
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
        Schema::dropIfExists('posts');
    }
}

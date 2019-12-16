<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class BlogPosts
 */
class BlogPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->unsignedInteger('author');
            $table->foreign('author')->references('id')->on('users');
            $table->text('summary');
            $table->text('lb_content')->nullable();
            $table->boolean('published')->default(false);
            $table->dateTimeTz('published_at');
            $table->timestamps();
        });

        Schema::create('blog_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('blog_post_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('blog_post_id');
            $table->foreign('blog_post_id')->references('id')->on('blog_posts')->onDelete('cascade');
            $table->unsignedInteger('blog_tag_id');
            $table->foreign('blog_tag_id')->references('id')->on('blog_tags')->onDelete('cascade');
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
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign(['author']);
        });

        Schema::table('blog_post_tags', function (Blueprint $table) {
           $table->dropForeign(['post_id']);
           $table->dropForeign(['blog_tag_id']);
        });

        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('blog_tags');
        Schema::dropIfExists('blog_post_tags');
    }
}

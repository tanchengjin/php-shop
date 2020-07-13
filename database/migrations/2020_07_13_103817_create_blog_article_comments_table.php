<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogArticleCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')->on('blogs')->references('id')->onDelete('cascade');
            $table->string('content', 255);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->on('blog_article_comments')->references('id')->onDelete('cascade');
            $table->string('path');
            $table->unsignedInteger('level');
            $table->softDeletes();
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
        Schema::dropIfExists('blog_article_comments');
    }
}

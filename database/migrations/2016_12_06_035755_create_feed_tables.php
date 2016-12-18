<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url_path');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categorys')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('feedItems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->string('title', 1000);
            $table->string('content', 10000);
            $table->string('feed_link', 400);
            $table->string('feed_item_id', 200);
            $table->dateTime('pubDate');
            $table->boolean('starred');
            $table->boolean('is_read');
            $table->integer('feed_id')->unsigned();
            $table->foreign('feed_id')->references('id')->on('feeds')->onDelete('cascade');
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
        Schema::drop('feedItems');
        Schema::drop('feeds');
        Schema::drop('categorys');
        Schema::drop('users');
    }
}

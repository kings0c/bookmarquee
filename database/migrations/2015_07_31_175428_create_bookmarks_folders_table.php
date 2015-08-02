<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarksFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks_folders', function (Blueprint $table) {
            $table->integer('bookmark_id')->unsigned();
            $table->foreign('bookmark_id')->references('bookmark_id')->on('bookmarks');
            $table->integer('folder_id')->unsigned();
            $table->foreign('folder_id')->references('folder_id')->on('folders');
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
        Schema::drop('bookmarks_folders');
    }
}

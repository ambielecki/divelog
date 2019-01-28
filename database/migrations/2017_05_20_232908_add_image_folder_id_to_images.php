<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddImageFolderIdToImages extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('images', function ($table) {
            $table->integer('image_folder_id')->unsigned();
            $table->foreign('image_folder_id')->references('id')->on('image_folders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('images', function ($table) {
            $table->dropForeign(['image_folder_id']);
            $table->dropColumn('image_folder_id');
        });
    }
}

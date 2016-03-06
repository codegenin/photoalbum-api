<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCoverPictureIdToAlbums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->integer('cover_picture_id')->nullable()->unsigned()->after('name');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->foreign('cover_picture_id')->references('id')->on('pictures')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->dropForeign('albums_cover_picture_id_foreign');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->dropColumn('cover_picture_id');
        });
    }
}

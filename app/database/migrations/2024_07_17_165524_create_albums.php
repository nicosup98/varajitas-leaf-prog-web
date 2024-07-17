<?php

use Leaf\Schema;
use Leaf\Database;
use Illuminate\Database\Schema\Blueprint;

class CreateAlbums extends Database
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        // if (!static::$capsule::schema()->hasTable('albums')) :
        //     static::$capsule::schema()->create('albums', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->timestamps();
        //     });
        // endif;

        // you can now build your migrations with schemas.
        // see: https://leafphp.dev/docs/mvc/schema.html
        Schema::build('albums');
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        static::$capsule::schema()->dropIfExists('albums');
    }
}

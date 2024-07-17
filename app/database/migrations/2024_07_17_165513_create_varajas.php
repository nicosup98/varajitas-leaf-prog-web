<?php

use Leaf\Schema;
use Leaf\Database;
use Illuminate\Database\Schema\Blueprint;

class CreateVarajas extends Database
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        // if (!static::$capsule::schema()->hasTable('varajas')) :
        //     static::$capsule::schema()->create('varajas', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->timestamps();
        //     });
        // endif;

        // you can now build your migrations with schemas.
        // see: https://leafphp.dev/docs/mvc/schema.html
        Schema::build('varajas');
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        static::$capsule::schema()->dropIfExists('varajas');
    }
}

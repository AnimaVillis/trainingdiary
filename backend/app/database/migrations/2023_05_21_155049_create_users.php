<?php

use Leaf\Database;
use Illuminate\Database\Schema\Blueprint;

class CreateUsers extends Database
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!static::$capsule::schema()->hasTable('users')) :
            static::$capsule::schema()->create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 50);
                $table->string('email', 50);
                $table->string('password', 150);
                $table->integer('user_level');
                $table->integer('first_login');
                $table->integer('account_activation');
                $table->timestamps();
            });
        endif;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        static::$capsule::schema()->dropIfExists('users');
    }
}

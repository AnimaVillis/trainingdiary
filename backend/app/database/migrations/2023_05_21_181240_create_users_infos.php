<?php

use Leaf\Database;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersInfos extends Database
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!static::$capsule::schema()->hasTable('users_info')) :
            static::$capsule::schema()->create('users_info', function (Blueprint $table) {
                $table->integer('users_id');
                $table->integer('initial_weight');
                $table->integer('current_weight');
                $table->integer('target_weight');
                $table->integer('growth');
                $table->integer('age');
                $table->string('activity_factor', 3);
                $table->string('sex', 5);
            });
        endif;

        // you can now build your migrations with schemas
        // Schema::build(static::$capsule, dirname(__DIR__) . '/Schema/users_infos.json');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        static::$capsule::schema()->dropIfExists('users_info');
    }
}

<?php

use Leaf\Database;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersWeights extends Database
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!static::$capsule::schema()->hasTable('users_weights')) :
            static::$capsule::schema()->create('users_weights', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('users_id');
                $table->integer('old_weight');
                $table->integer('new_weight');
                $table->timestamp('update_date', $precision = 0);
            });
        endif;

        // you can now build your migrations with schemas
        // Schema::build(static::$capsule, dirname(__DIR__) . '/Schema/users_weights.json');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        static::$capsule::schema()->dropIfExists('users_weights');
    }
}

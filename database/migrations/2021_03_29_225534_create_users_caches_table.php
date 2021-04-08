<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_caches', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('cache_id');
            $table->timestamp('found_at');
            $table->integer('points_given');
            $table->primary(['user_id', 'cache_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_caches');
    }
}

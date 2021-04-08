<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caches', function (Blueprint $table) {
            $table->id();
            $table->integer('num');
            $table->string('code');
            $table->string('type');
            $table->double('lat');
            $table->double('lon');
            $table->integer('points');
            $table->integer('nb_found')->default(0);
            $table->timestamp('found_at')->nullable();
            $table->timestamp('show_at')->nullable();
            $table->integer('bonus');
            $table->integer('time_bonus');
            $table->text('enigme');
            $table->string('src');
            $table->integer('difficulty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caches');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnigmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enigmes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->timestamp('found_at')->nullable();
            $table->timestamp('throttle');
            $table->text('propositions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enigmes');
    }
}

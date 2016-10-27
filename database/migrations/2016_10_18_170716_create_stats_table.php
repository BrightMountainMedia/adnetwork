<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->date('date')->nullable();
            $table->string('site')->nullable();
            $table->string('impressions')->nullable();
            $table->string('served')->nullable();
            $table->string('fill')->nullable();
            $table->string('income')->nullable();
            $table->string('ecpm')->nullable();
            $table->string('tag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats');
    }
}

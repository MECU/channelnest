<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('video_id');
            $table->string('title');
            $table->integer('type_id');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = new Blueprint('videos');
        $table->dropForeign(['type_id']);

        Schema::dropIfExists('videos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCharacterLinks extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        // Add table
        Schema::create('character_links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('parent_id')->unsigned();
            $table->integer('child_id')->unsigned();

            $table->foreign('parent_id')->references('id')->on('characters');
            $table->foreign('child_id')->references('id')->on('characters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        // drop table
        Schema::dropIfExists('character_links');
    }
}

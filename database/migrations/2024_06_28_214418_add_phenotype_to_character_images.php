<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhenotypeToCharacterImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('character_images', function (Blueprint $table) {
            $table->string('phenotype', 191)->nullable()->after('sort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('character_images', function (Blueprint $table) {
            $table->dropColumn('phenotype');
        });
    }
}

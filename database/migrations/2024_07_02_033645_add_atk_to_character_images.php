<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtkToCharacterImages extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('character_images', function (Blueprint $table) {
            $table->string('atk', 191)->nullable()->after('def');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::table('character_images', function (Blueprint $table) {
            $table->dropColumn('atk');
        });
    }
}

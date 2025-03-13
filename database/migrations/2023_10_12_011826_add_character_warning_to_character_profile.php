<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCharacterWarningToCharacterProfile extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('characters', function (Blueprint $table) {
            //
            $table->string('character_warning', 255)->nullable();
        });

        Schema::table('user_settings', function (Blueprint $table) {
            $table->tinyInteger('warning_visibility')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::table('characters', function (Blueprint $table) {
            //
            $table->dropColumn('character_warning');
        });

        Schema::table('user_settings', function (Blueprint $table) {
            $table->dropcolumn('warning_visibility');
        });
    }
}

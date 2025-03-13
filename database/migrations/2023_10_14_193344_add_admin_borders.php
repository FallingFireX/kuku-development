<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminBorders extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('borders', function (Blueprint $table) {
            $table->boolean('admin_only')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        //
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiteCredsTable extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('site_creds', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->string('key', 50)->unique()->primary(); // The name artist being credited, styled as "cred_name"
            $table->text('creator')->nullable()->default(null); // DeviantArt link to the creator.
            $table->text('credits'); // Images the creator is credited to.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('site_creds');
    }
}

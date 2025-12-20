<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('characters', function (Blueprint $table) {
            $table->text('semi_type')->nullable()->default(null); // set semi type
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn('semi_type');
        });
    }
};

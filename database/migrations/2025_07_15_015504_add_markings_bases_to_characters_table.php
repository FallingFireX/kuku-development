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
            //$table->string('markings', 250)->nullable()->after('rarity_id');
            $table->string('base', 20)->nullable()->after('genotype');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('characters', function (Blueprint $table) {
            //$table->dropColumn('markings');
            $table->dropColumn('base');
        });
    }
};

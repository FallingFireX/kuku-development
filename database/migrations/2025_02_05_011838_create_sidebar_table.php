<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('sidebar', function (Blueprint $table) {
            $table->id();
            $table->text('box1content')->nullable();
            $table->text('box2content')->nullable();
            $table->text('box3content')->nullable();
            $table->timestamps();
        });

        // Insert the first row with NULL values for box1content, box2content, and box3content
        DB::table('sidebar')->insert([
            'box1content' => null,
            'box2content' => null,
            'box3content' => null,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('sidebar');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unique_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('item_id');
            $table->string('item_slug')->nullable()->default(null);
            $table->integer('category_1');
            $table->integer('category_2')->nullable()->default(null);
            $table->string('link'); 
            $table->text('description');
            $table->integer('owner_id')->nullable()->default(null);
            $table->boolean('deleted')->default(0);
            $table->timestamps();

    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unique_items');
    }
};

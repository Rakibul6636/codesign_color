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
        Schema::create('palette_revisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('color_palette_id');
            $table->string('old_data');
            $table->timestamps();
    
            $table->foreign('color_palette_id')->references('id')->on('color_palettes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('palette_revisions');
    }
};

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
        Schema::create('color_palette_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('color_palette_id');
            $table->string('color_code'); // Separate column for color code
            $table->enum('color_type', [1, 2])->default(2); // 1 for dominant, 2 for accent
            $table->timestamps();
    
            $table->foreign('color_palette_id')->references('id')->on('color_palettes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_palette_colors');
    }
};

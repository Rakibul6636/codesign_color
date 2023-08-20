<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorPaletteColor extends Model
{
    use HasFactory;
    protected $fillable = ['color_palette_id', 'color_code', 'color_type'];

    public function palette()
    {
        return $this->belongsTo(ColorPalette::class, 'color_palette_id');
    }
}

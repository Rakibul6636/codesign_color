<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaletteRevision extends Model
{
    use HasFactory;
    protected $fillable = ['color_palette_id', 'old_data'];

    public function palette()
    {
        return $this->belongsTo(ColorPalette::class, 'color_palette_id');
    }
}

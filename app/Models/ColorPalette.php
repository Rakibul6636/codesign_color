<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorPalette extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'is_public', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function colors()
    {
        return $this->hasMany(ColorPaletteColor::class);
    }

    public function revisions()
    {
        return $this->hasMany(PaletteRevision::class);
    }
}

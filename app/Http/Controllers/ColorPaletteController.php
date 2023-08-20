<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ColorPalette;



class ColorPaletteController extends Controller
{
    public function publicPalettes()
    {
        $publicPalettes = ColorPalette::where('is_public', true)->get();
        return view('public-palette', ['colorPalettes' => $publicPalettes]);
    }

    public function searchByColor(Request $request)
    {
        $color = $request->input('color');

        $palettes = ColorPalette::whereHas('colors', function ($query) use ($color) {
            $query->where('color_code', $color);
        })->get();

        return response()->json($palettes);
    }
    public function createPaletteView()
    {
        return view('create-palette');
    }
    public function create(Request $request)
    {
        $user = Auth::user();
        //$user = $request->user();
        $isPublic = $request->input('is_public') === 'on';
        $palette = new ColorPalette([
            'name' => $request->input('name'),
            'is_public' => $isPublic,
            'user_id' => $user->id,
        ]);
        $palette->save();

        foreach ($request->input('colors') as $colorType => $colors) {
            foreach ($colors as $colorCode) {
                $palette->colors()->create([
                    'color_code' => $colorCode,
                    'color_type' => $colorType,
                ]);
            }
        }

        // Store a revision
        // $revisionData = $palette->toArray();
        // unset($revisionData['id'], $revisionData['created_at'], $revisionData['updated_at']);

        // $palette->revisions()->create([
        //     'old_data' => $revisionData,
        // ]);
        

        return response()->json(['message' => 'Palette added successfully.']);
    }

    public function favorite($id)
    {
        $user = Auth::user();
        $dd("here");
        $palette = ColorPalette::findOrFail($id);

        if ($palette->is_public && $palette->user_id !== $user->id) {
            $user->favorite_palettes()->syncWithoutDetaching($id);
            return response()->json(['message' => 'Palette added to favorites.']);
        }

        return response()->json(['message' => 'Palette cannot be added to favorites.']);
    }
}

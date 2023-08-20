<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColorPaletteController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('color-palettes-create-view', [ColorPaletteController::class, 'createPaletteView']);
// Public color palettes
Route::get('public-color-palettes', [ColorPaletteController::class, 'publicPalettes']);

// Search color palettes by color
Route::get('search-by-color', [ColorPaletteController::class, 'searchByColor']);

// Authentication routes
//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/login', [AuthController::class, 'login']);

// Protected routes (requires authentication)
Route::middleware('auth')->group(function () {
    // Create color palette vie
    Route::post('color-palettes-create-view', [ColorPaletteController::class, 'createPaletteView']);
    // Create color palette
    Route::post('color-palettes-store', [ColorPaletteController::class, 'create']);
    
    // Favorite a color palette
    Route::post('color-palettes/{id}/favorite', [ColorPaletteController::class, 'favorite']);
});
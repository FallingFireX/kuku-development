<?php

use App\Models\Character\Character;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/characters/count', function (Request $request) {
    $token = $request->header('X-API-KEY');
    if ($token !== config('discord.key')) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return response()->json([
        'count' => Character::where('is_myo_slot', 0)->count(),
    ]);
});

Route::get('/featured', function (Request $request) {
    return response()->json([
        'count' => Character::where('is_myo_slot', 0)->count(),
    ]);
});

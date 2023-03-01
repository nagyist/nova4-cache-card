<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Nagyist\Cachecardnova4\Http\Controllers\CacheCardController;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/
Route::controller(CacheCardController::class)->group(function () {
    Route::post('flush', 'flush');
    Route::post('cache','forget');
    Route::get('cache',  'get');
    Route::get('/',  'get');
});

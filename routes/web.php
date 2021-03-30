<?php

use App\Http\Controllers\GroupNameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [GroupNameController::class, 'viewIndex']);

Route::get('/calllists', [GroupNameController::class, 'viewCallLists'])->name('calllists');

Route::post('/changelevel', [GroupNameController::class, 'changeLevel'])->name('changelevel');
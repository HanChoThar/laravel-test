<?php

use App\Http\Controllers\ProcessPodcast\CreatePodcast;
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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('ProcessPodcast')->group(function () {
    Route::get('podcast-form', [CreatePodcast::class, 'showForm']);
    Route::post('podcast-create', [CreatePodcast::class, 'createPodcast']);
});

Route::prefix('jobs')->group(function () {
    Route::queueMonitor();
});
<?php

use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessPodcast\CreatePodcast;
use App\Jobs\firstJob;
use App\Jobs\jobBatch;
use App\Jobs\PaymentJob;
use App\Jobs\secondJob;
use App\Jobs\thirdJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;

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
Route::get('/', function() {
    return view('welcome');
});


/**
    * Queue Job testing
    *
*/
Route::get('/queue-job', function () {
    SendWelcomeEmail::dispatch();
    // PaymentJob::dispatch()->onQueue('payment');
    echo "Successfully queue job";
});

Route::get('/job-chaining', function() {
    $chain = [
        new firstJob,
        new secondJob,
        new thirdJob
    ];

    Bus::chain($chain)->dispatch();
    echo "Successfully queue job";
});

Route::get('/job-batching', function() {
    $batch = [
        new jobBatch('hello one'),
        new jobBatch('hello second'),
        new jobBatch('hello three'),
    ];

    Bus::batch($batch)->name('batching-test')->allowFailures()->dispatch();

    echo "Successfully job batching queue job";
});


Route::prefix('jobs')->group(function () {
    Route::queueMonitor();
});
<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\GetStarted;

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
    $users = \App\Models\User::with('uploadedFiles')->get();

    return view('welcome')->with('users', $users);
});

Route::post('/get-started', GetStarted::class)->name('get.started');

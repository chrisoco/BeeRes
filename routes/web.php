<?php

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

Route::get('/', function () { return view('index'); })->name('index');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {


    Route::group(['middleware' => 'beekeeperOnly'], function() {

        Route::get('profile', [App\Http\Controllers\BeekeeperController::class, 'profile'])->name('profile');
        Route::get('jurisdiction', [App\Http\Controllers\BeekeeperController::class, 'jurisdiction'])->name('jurisdiction');
        Route::post('jurisdiction/update', [App\Http\Controllers\BeekeeperController::class, 'updateJurisdiction'])->name('jurisdiction.update');
        Route::get('search/plz', [App\Http\Controllers\SearchController::class, 'searchPLZ'])->name('search.plz');

    });


});

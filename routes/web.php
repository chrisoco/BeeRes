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

Route::get('guest/search/plz',       [App\Http\Controllers\SearchController::class, 'guestSearchPLZ'      ])->name('guest.search.plz');
Route::get('guest/search/beekeeper', [App\Http\Controllers\SearchController::class, 'guestSearchBeekeeper'])->name('guest.search.beekeeper');

Route::group(['middleware' => 'auth'], function() {

    Route::group(['middleware' => 'beekeeperOnly'], function() {

        Route::get ('profile',               [App\Http\Controllers\BeekeeperController::class, 'profile'           ])->name('profile');
        Route::get ('jurisdiction',          [App\Http\Controllers\BeekeeperController::class, 'jurisdiction'      ])->name('jurisdiction');
        Route::post('jurisdiction/update',   [App\Http\Controllers\BeekeeperController::class, 'updateJurisdiction'])->name('jurisdiction.update');
        Route::get ('search/plz',            [App\Http\Controllers\SearchController::class,    'searchPLZ'         ])->name('search.plz');
        Route::get ('contract/{id}/accept',  [App\Http\Controllers\ContractController::class,  'accept'            ])->name('contract.accept');
        Route::get ('contract/taken',        [App\Http\Controllers\ContractController::class,  'taken'             ])->name('contract.taken');
        Route::get ('contract/{id}/success', [App\Http\Controllers\ContractController::class,  'success'           ])->name('contract.accept.success');
        Route::post('contract/{id}/accept',  [App\Http\Controllers\ContractController::class,  'acceptContract'    ])->name('contract.accept');

    });

    Route::group(['middleware' => 'adminOnly'], function() {

        Route::get ('contract/create',    [App\Http\Controllers\ContractController::class, 'create'])->name('contract.create');
        Route::post('contract/store',     [App\Http\Controllers\ContractController::class, 'store' ])->name('contract.store');
        Route::get ('contract/{id}/show', [App\Http\Controllers\ContractController::class, 'show'  ])->name('contract.show');

    });


});

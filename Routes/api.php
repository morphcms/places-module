<?php

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'places'], function () {
    Route::get('addresses', \Modules\Places\Http\Controllers\Address\IndexController::class);
    Route::get('addresses/{address:id}', \Modules\Places\Http\Controllers\Address\ShowController::class);
    Route::post('addresses', \Modules\Places\Http\Controllers\Address\StoreController::class);
    Route::put('addresses/{address:id}', \Modules\Places\Http\Controllers\Address\UpdateController::class);
    Route::delete('addresses/{address:id}', \Modules\Places\Http\Controllers\Address\DeleteController::class);

    Route::get('countries/search', \Modules\Places\Http\Controllers\Countries\SearchController::class);
    Route::get('states/search', \Modules\Places\Http\Controllers\States\SearchController::class);
});

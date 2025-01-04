<?php

use App\Http\Controllers\Api\V1\PackageController;
use App\Http\Controllers\Api\V1\ServiceCategoryController;
use App\Http\Controllers\Api\V1\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', \App\Http\Controllers\Api\Auth\LoginCotroller::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/all-category-list', function(){
	return \App\Models\ServiceCategory::query()->get();
});

//dashboard route
 Route::prefix('v1')->group(function () {
     Route::apiResources([
	 	 'service-category' => ServiceCategoryController::class,
         'service' => ServiceController::class,
         'package' => PackageController::class,
     ]);
 });



Route::get('/storage', fn()=> \Illuminate\Support\Facades\Artisan::call('storage:link'));

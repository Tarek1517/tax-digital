<?php

use App\Http\Controllers\Api\V1\PackageController;
use App\Http\Controllers\Api\V1\ServiceCategoryController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\PagesController;
use App\Http\Controllers\Api\V1\FooterController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\ClientsController;
use App\Http\Controllers\Api\V1\CustomerMailController;
use App\Http\Controllers\Api\V1\HomeSliderController;
use App\Http\Controllers\Api\V1\AboutHeroSectionController;
use App\Http\Controllers\Api\Frontend\V1\HomeController;
use App\Http\Controllers\Api\Frontend\V1\CustomerController;
use App\Http\Controllers\Api\Auth\Customer\CustomerAuthController;
use App\Http\Controllers\Api\Auth\Admin\AdminAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', \App\Http\Controllers\Api\Auth\LoginCotroller::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/admin', function (Request $request) {
    return $request->admin();
})->middleware('auth:sanctum');

Route::get('/all-category-list', function () {
    return \App\Models\ServiceCategory::query()->get();
});

//dashboard route
Route::prefix('v1')->middleware(['auth:sanctum', 'ability:role-admin'])->group(function () {
    Route::apiResources([
        'service-category' => ServiceCategoryController::class,
        'service' => ServiceController::class,
        'package' => PackageController::class,
        'setting' => SettingController::class,
        'pages' => PagesController::class,
        'footer' => FooterController::class,
        'custimer-mail' => CustomerMailController::class,
        'orders' => OrderController::class,
        'clients' => ClientsController::class,
        'hero-section' => HomeSliderController::class,
        'about-hero-sections' => AboutHeroSectionController::class,
    ]);

    Route::get('/all-page-list', [PagesController::class, 'allPageList']);
    Route::get('/dashboard', DashboardController::class);
    Route::get('/inactive-status/{id}', [HomeSliderController::class, 'inActiveStatus']);
    Route::get('/active-status/{id}', [HomeSliderController::class, 'activeStatus']);
    Route::get('/inactive-status/{id}', [AboutHeroSectionController::class, 'inActiveStatus']);
    Route::get('/active-status/{id}', [AboutHeroSectionController::class, 'activeStatus']);
});



Route::prefix('frontend/v1')->group(function () {
    Route::get('/get-categories', [HomeController::class, 'getCategories']);
    Route::get('/get-packages', [HomeController::class, 'getPackages']);
    Route::get('/get-all-settings', [HomeController::class, 'getAllSettings']);
    Route::get('/get-custom-page/{slug}', [HomeController::class, 'getCustomPage']);
    Route::get('/get-package-data/{slug}', [HomeController::class, 'getPackageData']);
    Route::post('/save-order', [OrderController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/store-mail', [CustomerController::class, 'store']);
    Route::get('/get-customer-order/{id}', [CustomerController::class, 'index'])->middleware('auth:sanctum');
    Route::apiResource('customer', CustomerController::class)->middleware('auth:sanctum');
    Route::get('/hero-section', [HomeController::class, 'getHeroData']);

});


// Auth Controller
Route::post('/customer/login', [CustomerAuthController::class, 'login']);
Route::post('/customer/register', [CustomerAuthController::class, 'register']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/customer/send-otp', [CustomerAuthController::class, 'sendOtp']);
Route::post('/customer/check-otp', [CustomerAuthController::class, 'checkOtp']);
Route::post('/customer/reset-password', [CustomerAuthController::class, 'resetPassword']);



Route::get('/storage', fn() => \Illuminate\Support\Facades\Artisan::call('storage:link'));

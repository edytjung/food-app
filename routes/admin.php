<?php

use App\Http\Controllers\Admin\AdminAuthController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Product\CategoryController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\ProductGalleryContoller;
use App\Http\Controllers\Admin\Product\ProductOptionController;
use App\Http\Controllers\Admin\Product\ProductSizeController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use Illuminate\Support\Facades\Route;




Route::group(['prefix'=> 'admin', 'as'=>'admin.'], function(){
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Profile Route
    Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::put('profile', [AdminProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Slider Route
    Route::resource('slider', SliderController::class);

    // Why Choose Us Route
    Route::put('why-choose-title-update', [WhyChooseUsController::class, 'updateTitle'])->name('why-choose-title.update');
    Route::resource('why-choose-us', WhyChooseUsController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);

    Route::get('product-gallery/{product}', [ProductGalleryContoller::class, 'index'])->name('product-gallery.show-index');
    Route::resource('product-gallery', ProductGalleryContoller::class);

    Route::get('product-size/{product}', [ProductSizeController::class, 'index'])->name('product-size.show-index');
    Route::resource('product-size', ProductSizeController::class);

    Route::resource('product-option', ProductOptionController::class);

    // Setting Route
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/general-setting', [SettingController::class, 'updateGeneralSetting'])->name('setting.generalUpdate');

});

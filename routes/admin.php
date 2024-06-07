<?php

use App\Http\Controllers\Admin\AdminAuthController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;




Route::group(['prefix'=> 'admin', 'as'=>'admin.'], function(){
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Profile Route
    Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::put('profile', [AdminProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Slider Route
    Route::resource('slider', SliderController::class);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProfileController as BackendProfileController;

Route::group(['prefix' => 'profile'], function () {
    Route::get('/{email}', [BackendProfileController::class, 'index'])->name('profile.show');
    Route::post('/edit/{id}', [BackendProfileController::class, 'edit_profile'])->name('profile.edit');
    Route::post('/password/{id}', [BackendProfileController::class, 'change_password'])->name('profile.password');
});

?>
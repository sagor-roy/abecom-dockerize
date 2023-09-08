<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;


Route::group(['prefix' => 'usermanagement'], function () {
    //role start
    Route::group(['prefix' => 'role'], function () {
        Route::get('all', [RoleController::class, 'index'])->name('role.all');
        Route::get('data', [RoleController::class, 'data'])->name('role.data');
        Route::post('add', [RoleController::class, 'add'])->name('role.add');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('update/{id}', [RoleController::class, 'update'])->name('role.update');
    });
    //role end

    //user start
    Route::group(['prefix' => 'user'], function () {
        Route::get('all', [UserController::class, 'index'])->name('user.all');
        Route::get('data', [UserController::class, 'data'])->name('user.data');
        Route::post('add', [UserController::class, 'add'])->name('user.add');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
        
        Route::get('updatepas/{id}', [UserController::class, 'password'])->name('user.password');
        Route::post('resetpassword/{id}', [UserController::class, 'reset'])->name('user.reset');
    });
    //user end
});
?>
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BrandController;

Route::group(['prefix' => 'brand'], function () {
    Route::get('/', [BrandController::class, 'index'])->name('brand.show');
    Route::get('/data', [BrandController::class, 'data'])->name('brand.data');
    Route::post('/add', [BrandController::class, 'add'])->name('brand.add');
    Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/inactive/modal/{id}', [BrandController::class, 'inactive_modal'])->name('brand.inactive.modal');
    Route::post('/inactive/{id}', [BrandController::class, 'inactive'])->name('brand.inactive');

    //banner route start
    Route::group(['prefix' => 'banner'], function(){
        Route::get('/data/{id}',[BrandController::class,'banner_data'])->name('brand.banner.data');
        Route::post('/add/{id}',[BrandController::class,'banner_add'])->name('brand.banner.add');
        Route::get('/edit/{id}',[BrandController::class,'banner_edit'])->name('brand.banner.edit');
        Route::post('/update/{id}',[BrandController::class,'banner_update'])->name('brand.banner.update');
        Route::get('/delete/modal/{id}',[BrandController::class,'banner_delete_modal'])->name('brand.banner.delete.modal');
        Route::post('/delete/{id}',[BrandController::class,'banner_delete'])->name('brand.banner.delete');
    });
    //banner route end

});

?>
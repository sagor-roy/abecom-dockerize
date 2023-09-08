<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SubCategoryController;

Route::group(['prefix' => 'subcategory'], function () {
    Route::get('/', [SubCategoryController::class, 'index'])->name('subcategory.show');
    Route::get('/data', [SubCategoryController::class, 'data'])->name('subcategory.data');
    Route::post('/add', [SubCategoryController::class, 'add'])->name('subcategory.add');
    Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');

    //banner route start
    Route::group(['prefix' => 'banner'], function(){
        Route::get('/data/{id}',[SubCategoryController::class,'banner_data'])->name('subcat.banner.data');
        Route::post('/add/{id}',[SubCategoryController::class,'banner_add'])->name('subcat.banner.add');
        Route::get('/edit/{id}',[SubCategoryController::class,'banner_edit'])->name('subcat.banner.edit');
        Route::post('/update/{id}',[SubCategoryController::class,'banner_update'])->name('subcat.banner.update');
        Route::get('/delete/modal/{id}',[SubCategoryController::class,'banner_delete_modal'])->name('subcat.banner.delete.modal');
        Route::post('/delete/{id}',[SubCategoryController::class,'banner_delete'])->name('subcat.banner.delete');
    });
    //banner route end

});
?>
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.show');
    Route::get('/data', [CategoryController::class, 'data'])->name('category.data');
    Route::post('/add', [CategoryController::class, 'add'])->name('category.add');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/inactive/modal/{id}', [CategoryController::class, 'inactive_modal'])->name('category.inactive.modal');
    // Route::post('/inactive/{id}', [CategoryController::class, 'inactive'])->name('category.inactive');

    //category attribute manage start
    Route::get('add/{id}/data/attr', [CategoryController::class, 'attr_data_add_modal'])->name('cat.attr.data.add.modal');
    
    Route::get('edit/{id}/data/attr', [CategoryController::class, 'attr_data'])->name('cat.attr.data');
    Route::post('cat/attr/add/{id}', [CategoryController::class, 'cat_attr_add'])->name('cat.attr.add');
    Route::get('cat/attr/edit/{id}', [CategoryController::class, 'cat_attr_edit'])->name('cat.attr.edit');
    Route::post('cat/attr/update/{id}', [CategoryController::class, 'cat_attr_update'])->name('cat.attr.update');
    //category attribute manage end

    //category banner start
    Route::get('edit/{id}/data/banner', [CategoryController::class, 'banner_data'])->name('cat.banner.data');
    Route::post('edit/banner/add/{id}', [CategoryController::class, 'banner_add'])->name('cat.banner.add');
    Route::get('edit/banner/{id}', [CategoryController::class, 'banner_edit'])->name('cat.banner.edit');
    Route::post('edit/banner/update/{id}', [CategoryController::class, 'banner_update'])->name('cat.banner.update');
    Route::get('edit/banner/delete/modal/{id}', [CategoryController::class, 'banner_delete_modal'])->name('cat.banner.delete.modal');
    Route::post('edit/banner/delete/{id}', [CategoryController::class, 'banner_delete'])->name('cat.banner.delete');
    //category banner end
});

?>
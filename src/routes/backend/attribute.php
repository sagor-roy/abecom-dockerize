<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AttributeController;


Route::group(['prefix' => 'attribute'], function () {
    Route::get('/', [AttributeController::class, 'index'])->name('attribute.show');
    Route::get('/data', [AttributeController::class, 'data'])->name('attribute.data');
    Route::post('/add', [AttributeController::class, 'add'])->name('attribute.add');
    Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('attribute.edit');
    Route::post('/update/{id}', [AttributeController::class, 'update'])->name('attribute.update');
    Route::get('/inactive/modal/{id}', [AttributeController::class, 'inactive_modal'])->name('attribute.inactive.modal');
    Route::post('/inactive/{id}', [AttributeController::class, 'inactive'])->name('attribute.inactive');
});

?>
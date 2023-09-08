<?php

use App\Http\Controllers\Backend\VarientController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'varient'], function () {
    Route::get('/', [VarientController::class, 'index'])->name('varient.show');
    Route::get('/data', [VarientController::class, 'data'])->name('varient.data');
    Route::post('/add', [VarientController::class, 'add'])->name('varient.add');
    Route::get('/edit/{id}', [VarientController::class, 'edit'])->name('varient.edit');
    Route::post('/update/{id}', [VarientController::class, 'update'])->name('varient.update');
});

?>
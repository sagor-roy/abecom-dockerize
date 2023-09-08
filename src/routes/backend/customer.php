<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SubscribersController;
use App\Http\Controllers\Backend\ContactController;


Route::group(['prefix' => 'customer'], function () {
    Route::get('/', [CustomerController::class, 'all'])->name('customer.all');
    Route::get('/data', [CustomerController::class, 'data'])->name('customer.data');
    Route::get('/reset/password/{id}', [CustomerController::class, 'reset_password_modal'])->name('customer.reset.password.modal');
    Route::post('/reset/password/{id}', [CustomerController::class, 'reset_password'])->name('customer.reset.password');
    Route::get('/edit/modal/{id}', [CustomerController::class, 'edit'])->name('customer.edit.modal');
    Route::post('/edit/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/view/modal/{id}', [CustomerController::class, 'view'])->name('customer.view.modal');

    //add birthday wish
    Route::get('/birthday/wish/{id}', [CustomerController::class, 'add_wish_modal'])->name('add.wish.modal');
    Route::post('/birthday/wish/{id}', [CustomerController::class, 'add_wish'])->name('add.wish');
    Route::post('/wish', [CustomerController::class, 'wish_all'])->name('wish.all');
    Route::get('/view/wish/{id}', [CustomerController::class, 'view_wish'])->name('view.wish');

    //email subscribers start
    Route::group(['prefix' => 'subscriber'], function(){
        Route::get('/',[SubscribersController::class,'index'])->name('subscribers.all');
        Route::get('/data',[SubscribersController::class,'data'])->name('subscribers.data');
        Route::get('/delete/modal/{id}',[SubscribersController::class,'delete_modal'])->name('subscribers.delete.modal');
        Route::post('/delete/{id}',[SubscribersController::class,'delete'])->name('subscribers.delete');
        Route::get('/delete/all',[SubscribersController::class,'delete_all'])->name('subscribers.delete.all');

        Route::get('/download_subscriber_list',[ReportController::class,'subscribers'])->name('subscribers.csv');
    });
    //email subscribers end

    //all messages start
    Route::group(['prefix' => 'messages'], function(){
        Route::get('/',[ContactController::class,'index'])->name('message.show');
        Route::get('/data',[ContactController::class,'data'])->name('message.data');
        Route::get('/delete/modal/{id}',[ContactController::class,'delete_modal'])->name('message.delete_modal');
        Route::post('/delete/{id}',[ContactController::class,'delete'])->name('message.delete');
        Route::get('/reply/modal/{id}',[ContactController::class,'reply_modal'])->name('message.reply.modal');
        Route::post('/reply/{id}',[ContactController::class,'reply'])->name('message.reply');
    });
    //all messages end

});
?>
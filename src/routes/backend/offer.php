<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\PurchasePointController;


Route::group(['prefix' => 'offer'], function () {
    //coupon code start
    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', [CouponController::class, 'index'])->name('coupon.show');
        Route::get('/data', [CouponController::class, 'data'])->name('coupon.data');
        Route::post('/add', [CouponController::class, 'add'])->name('coupon.add');
        Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
        Route::post('/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
    });
    //coupon code end

    //category wise offer start
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [OfferController::class, 'index'])->name('cat.offer.show');
        Route::get('/data', [OfferController::class, 'data'])->name('cat.offer.data');
        Route::post('/add', [OfferController::class, 'add'])->name('cat.offer.add');
        Route::get('/edit/{id}', [OfferController::class, 'edit'])->name('cat.offer.edit');
        Route::post('/update/{id}', [OfferController::class, 'update'])->name('cat.offer.update');

        Route::get('/view/{id}', [OfferController::class, 'view'])->name('cat.offer.view');
        // Route::get('/delete/{id}', [OfferController::class, 'delete_modal'])->name('cat.offer.delete.modal');
        // Route::post('/delete/{id}', [OfferController::class, 'delete'])->name('cat.offer.delete');
    });
    //category wise offer end

    //purchase point start
    Route::group(['prefix' => 'purchase/point/'], function () {
        Route::get('/', [PurchasePointController::class, 'index'])->name('purchase.point.show');
        Route::get('/data', [PurchasePointController::class, 'data'])->name('purchase.point.data');
        Route::post('/add', [PurchasePointController::class, 'add'])->name('purchase.point.add');
        Route::get('/edit/{id}', [PurchasePointController::class, 'edit'])->name('purchase.point.edit');
        Route::post('/update/{id}', [PurchasePointController::class, 'update'])->name('purchase.point.update');

        Route::post('/balance_point/{id}',[PurchasePointController::class,'balance_point'])->name('balance_point');
    });
    //purchase point end
});
?>
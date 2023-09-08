<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CourierController;
use App\Http\Controllers\Backend\DeliveryChargeController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PickUpController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ThanaController;

Route::group(['prefix' => 'ordermanagement'], function () {
    //all order start
    Route::group(['prefix' => '/order'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.all');
        Route::get('/data', [OrderController::class, 'data'])->name('order.data');
        Route::get('/view/{id}', [OrderController::class, 'view'])->name('order.view');
        Route::get('/status/edit/{id}', [OrderController::class, 'status_edit'])->name('status.edit');
        Route::post('/status/update/{id}', [OrderController::class, 'status_update'])->name('status.update');
        Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('invoice');
        Route::get('/mail/{id}', [OrderController::class, 'mail_modal'])->name('order.mail.modal');
        Route::post('/mail/{id}', [OrderController::class, 'mail'])->name('order.mail');
        Route::get('/mail/view/{id}', [OrderController::class, 'mail_view'])->name('order.mail.view');
    });
    //all order end

    //order report
    Route::post('/order/report', [ReportController::class, 'order_report'])->name('order.report');
    Route::post('/order/report/datetodate', [ReportController::class, 'order_report_date_to_date'])->name('order.report.date.to.date');

    //delivery charge start
    Route::group(['prefix' => '/deliverycharge'], function () {
        Route::get('/', [DeliveryChargeController::class, 'index'])->name('delivery.charge.all');
        Route::get('/data', [DeliveryChargeController::class, 'data'])->name('delivery.charge.data');
        Route::post('/add', [DeliveryChargeController::class, 'add'])->name('delivery.charge.add');
        Route::get('/edit/{id}', [DeliveryChargeController::class, 'edit'])->name('delivery.charge.edit');
        Route::post('/update/{id}', [DeliveryChargeController::class, 'update'])->name('delivery.charge.update');
    });
    //delivery charge end

    //cities start
    Route::group(['prefix' => 'cities'], function () {
        Route::get('/', [CityController::class, 'index'])->name('city.all');
        Route::get('/data', [CityController::class, 'data'])->name('city.data');
        Route::post('/add', [CityController::class, 'add'])->name('city.add');
        Route::get('/edit/{id}', [CityController::class, 'edit'])->name('city.edit');
        Route::post('/update/{id}', [CityController::class, 'update'])->name('city.update');
    });
    //cities end

    // Thana start

    Route::group(['prefix' => 'thanas'], function () {
        Route::get('/', [ThanaController::class, 'index'])->name('thana.all');
        Route::get('/data', [ThanaController::class, 'data'])->name('thana.data');
        Route::post('/add', [ThanaController::class, 'add'])->name('thana.add');
        Route::get('/edit/{id}', [ThanaController::class, 'edit'])->name('thana.edit');

        Route::post('/update/{id}', [ThanaController::class, 'update'])->name('thana.update');
    });

    // Thana end

    //courier start
    Route::group(['prefix' => 'courier'], function () {
        Route::get('/', [CourierController::class, 'index'])->name('courier.all');
        Route::get('/data', [CourierController::class, 'data'])->name('courier.data');
        Route::post('/add', [CourierController::class, 'add'])->name('courier.add');
        Route::get('/edit/{id}', [CourierController::class, 'edit'])->name('courier.edit');
        Route::post('/update/{id}', [CourierController::class, 'update'])->name('courier.update');
    });
    //courier end


    //pick up point route start
    Route::group(['prefix' => 'pickup'], function(){
        Route::get("/",[PickUpController::class,"index"])->name("pickup.point");
        Route::get("/data",[PickUpController::class,"data"])->name("pickup.point.data");

        Route::get("/add/modal",[PickUpController::class,"add_modal"])->name("pickup.point.add.modal");
        Route::post("/add",[PickUpController::class,"add"])->name("pickup.point.add");

        Route::get("/edit/{id}",[PickUpController::class,"edit_modal"])->name("pickup.point.edit.modal");
        Route::post("/edit/{id}",[PickUpController::class,"edit"])->name("pickup.point.edit");

    });
    //pick up point route end

    // Checkout page NB route Start
    Route::group(['prefix' => 'checkout_page_nb'], function(){

        // index route
        Route::get('/', [OrderController::class, 'checkout_page_nb'])->name('checkout.page.nb.index');

        // update route
        Route::post('/update/{id}', [OrderController::class, 'checkout_page_nb_update'])->name('checkout.page.nb.update');

    });
    // Checkout page NB route End

});
?>

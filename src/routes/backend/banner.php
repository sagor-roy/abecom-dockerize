<?php

use App\Http\Controllers\Backend\AllBannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeBannerController;
use App\Http\Controllers\Backend\TwoBannerController;
use App\Http\Controllers\Backend\SmallBannerController;


Route::group(['prefix' => 'banner'], function () {
    //home banner start
    Route::group(['prefix' => 'home'], function () {
        Route::get('/', [HomeBannerController::class, 'index'])->name('home.banner.all');
        Route::get('/data', [HomeBannerController::class, 'data'])->name('home.banner.data');
        Route::post('/add', [HomeBannerController::class, 'add'])->name('home.banner.add');
        Route::get('/edit/{id}', [HomeBannerController::class, 'edit'])->name('home.banner.edit');
        Route::post('/update/{id}', [HomeBannerController::class, 'update'])->name('home.banner.update');
        Route::get('/delete/modal/{id}', [HomeBannerController::class, 'delete_modal'])->name('home.banner.delete.modal');
        Route::post('/delete/{id}', [HomeBannerController::class, 'delete'])->name('home.banner.delete');
    });
    //home banner end

    //two banner start
    Route::group(['prefix' => 'twobanner'], function () {
        Route::get('/', [TwoBannerController::class, 'index'])->name('two.banner.show');
        Route::get('/data', [TwoBannerController::class, 'data'])->name('two.banner.data');
        Route::post('/add', [TwoBannerController::class, 'add'])->name('two.banner.add');
        Route::get('/edit/{id}', [TwoBannerController::class, 'edit'])->name('two.banner.edit');
        Route::post('/update/{id}', [TwoBannerController::class, 'update'])->name('two.banner.update');
        Route::get('/delete/modal/{id}', [TwoBannerController::class, 'delete_modal'])->name('two.banner.delete.modal');
        Route::post('/delete/{id}', [TwoBannerController::class, 'delete'])->name('two.banner.delete');
    });
    //two banner end

    //small banner start
    Route::group(['prefix' => 'smallbanner'], function(){
        Route::get("/",[SmallBannerController::class,'index'])->name('small.banner');
        Route::get("/data",[SmallBannerController::class,'data'])->name('small.banner.data');
        Route::post("/add",[SmallBannerController::class,'add'])->name('small.banner.add');
        Route::get("/edit/{id}",[SmallBannerController::class,'edit'])->name('small.banner.edit');
        Route::post("/update/{id}",[SmallBannerController::class,'update'])->name('small.banner.update');
        Route::get("/delete/modal{id}",[SmallBannerController::class,'delete_modal'])->name('small.banner.delete.modal');
        Route::post("/delete{id}",[SmallBannerController::class,'delete'])->name('small.banner.delete');
    });
    //small banner end

    //all banner start
    Route::group(['prefix' => 'allbanner'], function(){
        Route::get("/",[AllBannerController::class,"index"])->name("banner.all");
        Route::get("/data",[AllBannerController::class,"data"])->name("banner.data");
        
        Route::get("/add",[AllBannerController::class,"add_modal"])->name("banner.add.modal");
        Route::post("/add",[AllBannerController::class,"add"])->name("banner.add");
        
        Route::get("/edit/{id}",[AllBannerController::class,"edit"])->name("banner.edit");
        Route::post("/update/{id}",[AllBannerController::class,"update"])->name("banner.update");
        Route::get("/delete/modal/{id}",[AllBannerController::class,"delete_modal"])->name("banner.delete_modal");
        Route::post("/delete/{id}",[AllBannerController::class,"delete"])->name("banner.delete");
    });
    //all banner end

});
?>
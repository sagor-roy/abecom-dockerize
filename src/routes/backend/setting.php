<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BlockController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\ContactDetailsController;
use App\Http\Controllers\Backend\CountingController;
use App\Http\Controllers\Backend\CustomPagesController;
use App\Http\Controllers\Backend\FooterWidgetController;
use App\Http\Controllers\Backend\HomeGalleryController;
use App\Http\Controllers\Backend\BankPaymentController;
use App\Http\Controllers\Backend\ProductWarrantyController;
use App\Http\Controllers\Backend\SocialMediaController;


Route::group(['prefix' => 'settings'], function () {

    //contact details start
    Route::group(['prefix' => 'contact'], function () {
        Route::get('/', [ContactDetailsController::class, 'index'])->name('contact.show');
        Route::get('/data', [ContactDetailsController::class, 'data'])->name('contact.data');
        Route::get('/edit/{id}', [ContactDetailsController::class, 'edit'])->name('contact.edit');
        Route::post('/update/{id}', [ContactDetailsController::class, 'update'])->name('contact.update');
    });
    //contact details end

    //social media start
    Route::group(['prefix' => 'socialmedia'], function () {
        Route::get('/', [SocialMediaController::class, 'index'])->name('media.all');
        Route::get('/data', [SocialMediaController::class, 'data'])->name('media.data');
        Route::post('/add', [SocialMediaController::class, 'add'])->name('media.add');
        Route::get('/edit/{id}', [SocialMediaController::class, 'edit'])->name('media.edit');
        Route::post('/update/{id}', [SocialMediaController::class, 'update'])->name('media.update');
        Route::get('/delete/modal/{id}', [SocialMediaController::class, 'delete_modal'])->name('media.delete.modal');
        Route::post('/delete/{id}', [SocialMediaController::class, 'delete'])->name('media.delete');
    });
    //social media end

    //footer widget start
    Route::group(['prefix' => 'widget'], function () {
        Route::get('/', [FooterWidgetController::class, 'index'])->name('widget.all');
        Route::get('/data', [FooterWidgetController::class, 'data'])->name('widget.data');
        Route::post('/add', [FooterWidgetController::class, 'add'])->name('widget.add');
        Route::get('/edit/{id}', [FooterWidgetController::class, 'edit'])->name('widget.edit');
        Route::post('/update/{id}', [FooterWidgetController::class, 'update'])->name('widget.update');
        Route::get('/delete/modal/{id}', [FooterWidgetController::class, 'delete_modal'])->name('widget.delete.modal');
        Route::post('/delete/{id}', [FooterWidgetController::class, 'delete'])->name('widget.delete');
    });
    //footer widget end

    //our client start
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.show');
        Route::get('/data', [ClientController::class, 'data'])->name('client.data');
        Route::post('/add', [ClientController::class, 'add'])->name('client.add');
        Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
        Route::post('/update/{id}', [ClientController::class, 'update'])->name('client.update');
        Route::get('/delete/modal/{id}', [ClientController::class, 'delete_modal'])->name('client.delete.modal');
        Route::post('/delete/{id}', [ClientController::class, 'delete'])->name('client.delete');
    });
    //our client end

    //home page gallery start
    Route::group(['prefix' => 'homegallery'], function () {
        Route::get('/', [HomeGalleryController::class, 'index'])->name('home.gallery.all');
        Route::get('/data', [HomeGalleryController::class, 'data'])->name('home.gallery.data');
        Route::post('/add', [HomeGalleryController::class, 'add'])->name('home.gallery.add');
        Route::get('/edit/{id}', [HomeGalleryController::class, 'edit'])->name('home.gallery.edit');
        Route::post('/update/{id}', [HomeGalleryController::class, 'update'])->name('home.gallery.update');
        Route::get('/delete/modal{id}', [HomeGalleryController::class, 'delete_modal'])->name('home.gallery.delete.modal');
        Route::post('/delete/{id}', [HomeGalleryController::class, 'delete'])->name('home.gallery.delete');
    });
    //home page gallery end

    //total counting start
    Route::group(['prefix' => 'counting'], function () {
        Route::get('/', [CountingController::class, 'index'])->name('count.all');
        Route::post('/edit', [CountingController::class, 'edit'])->name('count.edit');
    });
    //total counting end

    //create block route start
    Route::group(['prefix' => 'block'], function(){
        Route::get('/',[BlockController::class,'index'])->name('block.all');
        Route::get('/data',[BlockController::class,'data'])->name('block.data');
        Route::post('/add',[BlockController::class,'add'])->name('block.add');
        Route::get('/edit/{id}',[BlockController::class,'edit'])->name('block.edit');
        Route::post('/update/{id}',[BlockController::class,'update'])->name('block.update');
    });
    //create block route end

    // Product Warranty route start
    Route::group(['prefix' => 'product-warranty'], function() {

        // index route
        Route::get('/',[ProductWarrantyController::class,'index'])->name('product.warranty.index');

        // update route
        Route::post('/update/{id}',[ProductWarrantyController::class,'update'])->name('product.warranty.update');

    });
    // Product Warranty route end

    //custom pages start
    Route::group(['prefix' => 'custom-pages'], function(){
        Route::get('/',[CustomPagesController::class,'index'])->name('custom.page');
        Route::get('data',[CustomPagesController::class,'data'])->name('custom.page.data');
        Route::get('add-modal',[CustomPagesController::class,'add_modal'])->name('custom.page.add.modal');
        Route::post('add',[CustomPagesController::class,'add'])->name('custom.page.add');
        Route::get('edit-modal/{id}',[CustomPagesController::class,'edit_modal'])->name('custom.page.edit.modal');
        Route::post('edit/{id}',[CustomPagesController::class,'edit'])->name('custom.page.edit');
        Route::get('delete-modal/{id}',[CustomPagesController::class,'delete_modal'])->name('custom.page.delete.modal');
        Route::post('delete/{id}',[CustomPagesController::class,'delete'])->name('custom.page.delete');
    });
    //custom pages end

    //Bank Payment start
    Route::group(['prefix' => 'bank-payment'], function(){
        Route::get('/',[BankPaymentController::class,'index'])->name('bank_payment.all');
        Route::put('/',[BankPaymentController::class,'update'])->name('bank_payment.update');
    });
    //Bank Payment end


});
?>

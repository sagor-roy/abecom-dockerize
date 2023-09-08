<?php

use App\Http\Controllers\Backend\PriceMatchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\QuestionAnswerController;
use App\Http\Controllers\Backend\ReviewController as BackendReviewController;
use App\Http\Controllers\Backend\ProductController;

Route::group(['prefix' => 'product'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.show');
    Route::get('/data', [ProductController::class, 'data'])->name('product.data');
    Route::get('/add/page', [ProductController::class, 'add_page'])->name('product.add.view');
    Route::post('/add', [ProductController::class, 'add'])->name('product.add');
    Route::get('/view/page/{id}', [ProductController::class, 'view_page'])->name('product.view.page');
    Route::get('/edit/page/{id}', [ProductController::class, 'edit_page'])->name('product.edit.page');
    Route::post('/edit/product/basic/{id}', [ProductController::class, 'edit_basic'])->name('product.edit.basic');

    //product image add/edit/delete start
    Route::get('/data/image/{id}', [ProductController::class, 'image_data'])->name('product.image.data');
    Route::post('/add/image/{id}', [ProductController::class, 'add_image'])->name('add.product.image');
    Route::get('/edit/image/modal/{id}', [ProductController::class, 'edit_image_modal'])->name('edit.product.image.modal');
    Route::post('/edit/image/{id}', [ProductController::class, 'edit_image'])->name('edit.product.image');
    Route::get('/delete/image/modal/{id}', [ProductController::class, 'delete_image_modal'])->name('delete.product.image.modal');
    Route::post('/delete/image/{id}', [ProductController::class, 'delete_image'])->name('delete.product.image');
    //product image add/edit/delete end

    //product attribute start
    Route::post('/add/attribute/{id}', [ProductController::class, 'add_product_attribute'])->name('add.product.attribute');
    Route::post('/edit/attribute/{id}', [ProductController::class, 'update_product_attribute'])->name('update.product.attribute');
    //product attribute end

    //product varient value start
    Route::get('/edit/page/{id}/data', [ProductController::class, 'product_varient_value_data'])->name('product.varient.val.data');
    Route::post('/add/varient/{id}', [ProductController::class, 'add_product_varient'])->name('add.product.varient');
    Route::get('/edit/varient/{id}', [ProductController::class, 'edit_product_varient_modal'])->name('edit.product.attr.value.modal');
    Route::post('/update/varient/{id}', [ProductController::class, 'update_product_varient'])->name('update.product.varient');
    Route::get('/delete/varient/{id}', [ProductController::class, 'delete_product_varient_modal'])->name('delete.product.attr.value.modal');
    Route::post('/delete/varient/{id}', [ProductController::class, 'delete_product_varient'])->name('delete.product.varient');
    //product varient value end

    //product review start
    Route::group(['prefix' => 'review'], function () {
        Route::get('/', [BackendReviewController::class, 'index'])->name('review.show');
        Route::get('/data', [BackendReviewController::class, 'data'])->name('review.data');
        Route::get('/edit/{id}', [BackendReviewController::class, 'edit'])->name('review.edit');
        Route::post('/update/{id}', [BackendReviewController::class, 'update'])->name('review.update');

        Route::get('/delete/modal/{id}', [BackendReviewController::class, 'delete_modal'])->name('review.delete.modal');
        Route::post('/delete/{id}', [BackendReviewController::class, 'delete'])->name('review.delete');

        Route::get('/delete/all', [BackendReviewController::class, 'delete_all'])->name('review.delete.all');
        Route::get('/approve/all', [BackendReviewController::class, 'approve_all'])->name('review.approve.all');
        Route::get('/unapprove/all', [BackendReviewController::class, 'unapprove_all'])->name('review.unapprove.all');
    });
    //product review end

    //product question and answer start
    Route::group(['prefix' => 'qa'], function(){
        Route::get("/",[QuestionAnswerController::class,'index'])->name('product.qa');
        Route::get("/data",[QuestionAnswerController::class,'data'])->name('product.qa.data');
        Route::get("/reply/{id}",[QuestionAnswerController::class,'reply'])->name('product.qa.reply');
        Route::post("/answer/{id}",[QuestionAnswerController::class,'answer'])->name('product.qa.answer');
        
        Route::get("/edit/{id}",[QuestionAnswerController::class,'edit'])->name('product.qa.edit');
        Route::post("/update/{id}",[QuestionAnswerController::class,'update'])->name('product.qa.update');
        
    });
    //product question and answer end

    //product price matching form start
    Route::group(['prefix' => 'pricematching'], function(){
        Route::get("/",[PriceMatchController::class,"index"])->name("price.matching");
        Route::get("/data",[PriceMatchController::class,"data"])->name("price.data");
        Route::get("/reply/modal/{id}",[PriceMatchController::class,"reply_modal"])->name("reply.modal");
        Route::post("/reply/{id}",[PriceMatchController::class,"reply"])->name("price.match.reply");
        Route::get("/delete/modal/{id}",[PriceMatchController::class,"delete_modal"])->name("price.match.delete.modal");
        Route::post("/delete/{id}",[PriceMatchController::class,"delete"])->name("price.match.delete");
        Route::get("/deleteall",[PriceMatchController::class,"delete_all"])->name("price.match.delete.all");
    });
    //product price matching form end

});
?>
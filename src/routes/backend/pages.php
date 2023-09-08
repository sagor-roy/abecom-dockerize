<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AboutBlockController;
use App\Http\Controllers\Backend\AboutCertificateController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\CorporateSalesController;
use App\Http\Controllers\Backend\OurStoresController;
use App\Http\Controllers\Backend\ServiceComplaintController;

Route::group(['prefix' => 'allpages'], function(){

    //about us page start
    Route::group(['prefix' => 'about'], function(){
        Route::get("/",[AboutController::class,'index'])->name("about.show");

        Route::group(['prefix'=>'iso'], function(){
            Route::get("/data",[AboutController::class,'data'])->name("about.data");
            Route::get("/edit/{id}",[AboutController::class,'edit'])->name("about.edit");
            Route::post("/edit/{id}",[AboutController::class,'update'])->name("about.update");
        });

        Route::group(['prefix' => 'block'], function(){
            Route::get("/data",[AboutBlockController::class,'data'])->name("about.block.data");
            Route::get("/add",[AboutBlockController::class,'add_modal'])->name("about.block.add.modal");
            Route::post("/add",[AboutBlockController::class,'add'])->name("about.block.add");
            Route::get("/edit/{id}",[AboutBlockController::class,'edit'])->name("about.block.edit");
            Route::post("/update/{id}",[AboutBlockController::class,'update'])->name("about.block.update");
            Route::get("/delete/modal/{id}",[AboutBlockController::class,'delete_modal'])->name("about.block.delete.modal");
            Route::post("/delete/{id}",[AboutBlockController::class,'delete'])->name("about.block.delete");
        });

        Route::group(['prefix' => 'certificate'], function(){
            Route::get("/data",[AboutCertificateController::class,"data"])->name("about.certificate.data");
            Route::get("/add",[AboutCertificateController::class,'add_modal'])->name("about.certificate.add.modal");
            Route::post("/add",[AboutCertificateController::class,"add"])->name("about.certificate.add");
            Route::get("/edit/{id}",[AboutCertificateController::class,"edit"])->name("about.certificate.edit");
            Route::post("/update/{id}",[AboutCertificateController::class,"update"])->name("about.certificate.update");
            Route::get("/delete/modal{id}",[AboutCertificateController::class,"delete_modal"])->name("about.certificate.delete_modal");
            Route::post("/delete/{id}",[AboutCertificateController::class,"delete"])->name("about.certificate.delete");
        });

    });
    //about us page end

    //stores page start
    Route::group(["prefix" => "stores"], function(){
        Route::get("/",[OurStoresController::class,"index"])->name("stores.show");
        Route::get("/data",[OurStoresController::class,"data"])->name("stores.data");
        Route::post("/add",[OurStoresController::class,"add"])->name("stores.add");
        Route::get("/edit/{id}",[OurStoresController::class,"edit"])->name("stores.edit");
        Route::post("/update/{id}",[OurStoresController::class,"update"])->name("stores.update");
        Route::get("/delete/modal{id}",[OurStoresController::class,"delete_modal"])->name("stores.delete_modal");
        Route::post("/delete/{id}",[OurStoresController::class,"delete"])->name("stores.delete");
    });
    //stores page end

    //corporate sales page start
    Route::group(["prefix" => "corporatesale"], function(){
        Route::get("/",[CorporateSalesController::class,"index"])->name("corporate.sale");
        Route::get("/data",[CorporateSalesController::class,"data"])->name("corporate.sale.data");
        Route::post("/update",[CorporateSalesController::class,"update"])->name("corporate.sale.update");
        Route::get("/reply/{id}",[CorporateSalesController::class,"reply_modal"])->name("corporate.sale.reply.modal");
        Route::post("/reply/{id}",[CorporateSalesController::class,"reply"])->name("corporate.sale.reply");
        Route::get("/reply/delete/modal/{id}",[CorporateSalesController::class,"reply_delete_modal"])->name("corporate.sale.reply.delete.modal");
        Route::post("/reply/delete/{id}",[CorporateSalesController::class,"reply_delete"])->name("corporate.sale.reply.delete");
    });
    //corporate sales page end

    //service complaint page start
    Route::group(["prefix" => "servicecomplaint"], function(){
        Route::get("/",[ServiceComplaintController::class,"index"])->name("service.complaint");
        Route::get("/data",[ServiceComplaintController::class,"data"])->name("service.complaint.data");
        Route::post("/update",[ServiceComplaintController::class,"update"])->name("service.complaint.update");
        Route::get("/reply/{id}",[ServiceComplaintController::class,"reply_modal"])->name("service.complaint.reply.modal");
        Route::post("/reply/{id}",[ServiceComplaintController::class,"reply"])->name("service.complaint.reply");
        Route::get("/reply/delete/modal/{id}",[ServiceComplaintController::class,"reply_delete_modal"])->name("service.complaint.reply.delete.modal");
        Route::post("/reply/delete/{id}",[ServiceComplaintController::class,"reply_delete"])->name("service.complaint.reply.delete");
    });
    //service complaint page end

});
?>

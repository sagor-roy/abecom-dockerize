<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
//use Spatie\Analytics\Analytics;
//use Analytics;
use Spatie\Analytics\Period;

Route::get('/cache', function () {
    Artisan::call("migrate");
    Artisan::call("db:seed");
    Artisan::call("config:cache");
    Artisan::call("cache:clear");
    Artisan::call("route:clear");
    Artisan::call("db:seed");
    return "Success";
});

/*
|--------------------------------------------------------------------------
| Backend Routes Start
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/adminpanel', [LoginController::class, 'login_show'])->name('login.show');
// Route::get('/registeradmin', [RegisterController::class, 'register_show'])->name('register.show');
Route::get('/registeradmin', function () {
    return view('errors.404');
})->name('register.show');

Route::post('/do-register', [RegisterController::class, 'do_register'])->name('do.register');
Route::post('/do-login', [LoginController::class, 'do_login'])->name('do.login');

Route::get('/forget-password', [ForgetPasswordController::class, 'getEmail'])->name('get.email');
Route::post('/forget-password', [ForgetPasswordController::class, 'postEmail'])->name('post.email');
Route::get('reset-password/{token}/{email}', [ForgetPasswordController::class, 'getPassword'])->name('get.password');
Route::post('reset-password/{email}', [ForgetPasswordController::class, 'reset_password'])->name('password.reset');

Route::post('/do-logout', [LogoutController::class, 'do_logout'])->name('do.logout');

Route::get('/fontawesome', [DashboardController::class, 'icon']);

//backend route group start
Route::group(['prefix' => 'admindashboard', 'middleware' => 'auth'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/product_request_chart', [DashboardController::class, 'product_request_chart'])->name('product_request_chart');
    Route::get('/category_product_chart', [DashboardController::class, 'category_product_chart'])->name('category_product_chart');
    Route::get('/category_attribute_chart', [DashboardController::class, 'category_attribute_chart'])->name('category_attribute_chart');

    //profile management start
    require_once "backend/profile.php";
    //profile management end

    //category management start
    require_once "backend/category.php";
    //category management end

    //subcategory management start
    require_once "backend/subcategory.php";
    //subcategory management end

    //brand management start
    require_once "backend/brand.php";
    //brand management end

    //varient management start
    require_once "backend/varient.php";
    //varient management end

    //attribute management start
    require_once "backend/attribute.php";
    //attribute management end

    //product management start
    require_once "backend/product.php";
    //product management end

    //offer management start
    require_once "backend/offer.php";
    //offer management end

    //customer management start
    require_once "backend/customer.php";
    //customer management end

    //user management start
    require_once "backend/user.php";
    //user management end

    //banner route start
    require_once "backend/banner.php";
    //banner route end

    //settings  start
    require_once "backend/setting.php";
    //settings  end

    //order management start
    require_once "backend/order.php";
    //order management end


    //all pages start
    require_once "backend/pages.php";
    //all pages end

    Route::get('/analytics', function() {
        // $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        return $analyticsData;
    });

});
//backend route group end

//category and sub category dynamic dependent start
Route::get('category_dependent/{id}', [ProductController::class, 'dynamic_dependent']);
Route::get('category_varient_dependent/{id}', [ProductController::class, 'varient_dependent']);
//category and sub category dynamic dependent end

/*
|--------------------------------------------------------------------------
| Backend Routes End
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Frontend Routes Start
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require_once "frontend/frontend.php";
/*
|--------------------------------------------------------------------------
| Frontend Routes End
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



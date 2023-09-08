<?php

use App\Http\Controllers\Backend\CorporateSalesController;
use App\Http\Controllers\Backend\ServiceComplaintController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Auth\ForgetPassword;
use App\Http\Controllers\Frontend\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\Frontend\BrandController as FrontendBrandController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CompareproductController;
use App\Http\Controllers\Frontend\CouponController as FrontendCouponController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\GuestCheckoutController;
use App\Http\Controllers\Frontend\OrderTrackingController;
use App\Http\Controllers\Frontend\PriceMatchController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\QuestionAnswerController as FrontendQuestionAnswerController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\SubCategoryFilterController;
use App\Http\Controllers\Frontend\ThController;
use App\Http\Controllers\Frontend\WishlistController;



Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contact_send'])->name('contact.send');
Route::get('/stores', [FrontendController::class, 'stores'])->name('stores');
Route::get('/corporatesale', [FrontendController::class, 'corporate_sale'])->name('corporate_sale');
Route::post('/corporatesale/add', [CorporateSalesController::class, 'add'])->name('corporate.sale.add');
Route::get('/servicecomplaint', [FrontendController::class, 'service_complaint'])->name('service_complaint');
Route::post('/servicecomplaint/add', [ServiceComplaintController::class, 'add'])->name('service.complaint.add');



Route::get('/login', [FrontendController::class, 'login'])->name('login');
Route::post('/login', [AuthLoginController::class, 'login'])->name('login');

Route::post('/logout', [AuthLoginController::class, 'logout'])->name('logout');

Route::get('/register', [FrontendController::class, 'register'])->name('register');
Route::post('/register', [AuthRegisterController::class, 'register'])->name('register');

Route::get('/forgetpassword', [ForgetPassword::class, 'forget_email'])->name('forget.email');
Route::post('/forgetpassword', [ForgetPassword::class, 'get_code'])->name('get.code');
Route::get('/password-reset/{token}/{email}', [ForgetPassword::class, 'change_pass'])->name('change.pass.page');
Route::post('password-reset/{email}', [ForgetPassword::class, 'reset_password'])->name('change.password');

//Socialite Facebook and google login
Route::get('/login/google', [AuthLoginController::class, 'googleLogin'])->name('google.login');
Route::get('/login/google/callback', [AuthLoginController::class, 'redirectGoogle']);

Route::get('/login/facebook', [AuthLoginController::class, 'facebookLogin'])->name('facebook.login');
Route::get('/login/facebook/callback', [AuthLoginController::class, 'redirectFacebook']);

//mobile login
Route::get("/login/mobile",[AuthLoginController::class,'login_mobile'])->name("mobile.login");
Route::get("/otp/validation",[AuthLoginController::class,'otp_validation'])->name("otp.validation");

//category page functionality start
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('category');

//sub category group start
Route::get('/subcategory/{slug}', [FrontendController::class, 'subcategory'])->name('subcategory');
//sub category group end

//brand group start
Route::get('/brand/{slug}', [FrontendController::class, 'brand'])->name('brand');
//brand group end

//home page product block brand filtering
Route::get('/home/block/{block_id}/category/{cat_id}/brand/{brand_id}', [FrontendController::class, 'home_brand_filter']);
Route::get('/home/block/{block_id}/brand/{brand_id}/category/{cat_id}', [FrontendController::class, 'home_category_filter']);

//home page offer filter
Route::get('/home/offer/filter/{id}', [FrontendController::class, 'home_offer_filter']);

//home page type wise product filter start
Route::get('/home/producttype/filter/{id}', [FrontendController::class, 'home_product_type_filter']);

//price filter
Route::get('/min/{min}/max/{max}/cat/{id}', [FrontendController::class, 'price_filter']);
Route::get('/min/{min}/max/{max}/brand/{id}', [FrontendBrandController::class, 'price_filter']);
Route::get('/sub/cat/{id}/min/{min}/max/{max}', [SubCategoryFilterController::class, 'price_filter']);

Route::get('/sub_cat/{id}', [FrontendController::class, 'sub_cat_filter']);
Route::get('/sub_cat/{id}/brand/{brand}', [FrontendBrandController::class, 'sub_cat_filter']);
Route::get('/category/{id}/brand/{brand}', [FrontendBrandController::class, 'cat_filter']);

//brand filter
Route::get('/brand/{id}/cat/{cat_id}', [FrontendController::class, 'brand_filter']);
Route::get('/brand/{id}/subcat/{sub_cat_id}', [SubCategoryFilterController::class, 'brand_filter']);

Route::get('/category_attribute/{cat_var_id}', [FrontendController::class, 'category_attribute_filter']);
Route::get('/category_attribute/{cat_var_id}/subcat/{id}', [SubCategoryFilterController::class, 'subcategory_attribute_filter']);
//category page functionality end

//search
Route::get('/search', [FrontendController::class, 'search'])->name('search');

Route::get('/privacypolicy', [FrontendController::class, 'privacypolicy'])->name('privacypolicy');

Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::get('/offer', [FrontendController::class, 'offer'])->name('offer');
Route::get('/offer/{slug}', [FrontendController::class, 'offer_single'])->name('offer.single');
Route::get('/offerfilter', [FrontendController::class, 'offer_filter'])->name('offer.filter');
Route::get('/offer-subcategory-filter', [FrontendController::class, 'offer_subcategory_filter'])->name('offer.subcategory.filter');
Route::get('/productdetails/{slug}', [FrontendController::class, 'productdetails'])->name('productdetails');
Route::post("/pricematch",[PriceMatchController::class,"pricematch"])->name("pricematch");
Route::get('/socialshare', [FrontendController::class, 'social_share'])->name('social.share');

//customer review route
Route::post('/add/review/{id}', [ReviewController::class, 'add_review'])->name('review.add');
Route::post('/add/question/{id}', [FrontendQuestionAnswerController::class, 'add_question'])->name('question.add');

//wishlist product start
Route::get('/addToWishlist/{id}', [WishlistController::class, 'product_wishlist']);
Route::post('/removeWishlist/{id}', [WishlistController::class, 'remove_wishlist'])->name('remove.wishlist');

//shop page route start
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('price/min/{min}/max/{max}', [ShopController::class, 'price_filter_shop']);
Route::get('shop/category/{id}', [ShopController::class, 'category_filter']);
Route::get('shop/subcategory/{id}', [ShopController::class, 'subcategory_filter']);
Route::get('shop/brand/{id}', [ShopController::class, 'brand_filter']);
//shop page route end

//add to cart route start
Route::get('/getcart', [CartController::class, 'get_cart']);
Route::get('/addToCart/{varient}/quantity/{quantity}/product/{product}/', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('addToCart/plus/{id}/quantity/{quantity}/varient/{varient}', [CartController::class, 'cart_plus']);
Route::get('addToCart/minus/{id}/varient/{varient}', [CartController::class, 'cart_minus']);
Route::get('addToCart/remove/{id}/varient/{varient}', [CartController::class, 'cart_remove']);
//add to cart route end

//coupon code route start
Route::get('/add/coupon/{code}', [FrontendCouponController::class, 'add_coupon']);
Route::get('/get/price', [FrontendCouponController::class, 'get_price']);
//coupon code route end

//checkout start
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('do.checkout');
//checkout end

//courier
Route::get('/courier/{id}', [FrontendController::class, 'courier']);

//guest checkout start
Route::post('/guestverification', [GuestCheckoutController::class, 'guest_verification'])->name('guest.verification');
Route::post('/emailverificationforguestceckout', [GuestCheckoutController::class, 'email_verification']);
Route::get('/guestcheckout', [GuestCheckoutController::class, 'guest_checkout'])->name('guest.checkout');
Route::post('/guestcheckout', [GuestCheckoutController::class, 'do_guest_checkout'])->name('do.guest.checkout');
//guest checkout end

//ssl commerze start
Route::post('sslcommerz/success', [CheckoutController::class, 'SSLSuccess']);
Route::post('sslcommerz/failed', [CheckoutController::class, 'SSLFailed']);
Route::post('sslcommerz/cancel', [CheckoutController::class, 'SSLCancel']);
Route::post('sslcommerz/ipn', [CheckoutController::class, 'SSLIpn']);
//ssl commerze end

//guest ssl commerze start
Route::post('guest/sslcommerz/success', [GuestCheckoutController::class, 'SSLSuccess']);
Route::post('guest/sslcommerz/failed', [GuestCheckoutController::class, 'SSLFailed']);
Route::post('guest/sslcommerz/cancel', [GuestCheckoutController::class, 'SSLCancel']);
Route::post('guest/sslcommerz/ipn', [GuestCheckoutController::class, 'SSLIpn']);
//guest ssl commerze end

//compare product start
Route::get('/compare', [CompareproductController::class, 'compare'])->name('compare.show');
Route::post('/addToCompare', [CompareproductController::class, 'product_compare']);
Route::get('/getCompare', [CompareproductController::class, 'get_compare']);
Route::get('/deleteCompare/{id}', [CompareproductController::class, 'delete_compare']);

Route::group(['prefix' => 'profile'], function () {
    Route::get('/{id}', [FrontendController::class, 'profile'])->name('profile');
    Route::get('/{id}/orderdetails/{order_id}', [ProfileController::class, 'order_details'])->name('order.details');
    Route::post('/basicinfo/{id}', [ProfileController::class, 'profile_basic_info'])->name('profile.basic.info');
    Route::post('/changepass/{id}', [ProfileController::class, 'profile_change_pass'])->name('profile.pass.change');
    Route::post('/cancel/order/{id}', [ProfileController::class, 'profile_cancel_order'])->name('profile.cancel.order');
});

//order track
Route::group(['prefix' => 'ordertrack'], function () {
    Route::get('/{token}/{id}', [OrderTrackingController::class, 'index'])->name('order.track');
    Route::post('/track', [OrderTrackingController::class, 'track'])->name('track');
});

//email subscribe
Route::post('/email/subscribe', [FrontendController::class, 'subscribe'])->name('email.subscribe');

//category page th filter
Route::get("/thfilter/category",[ThController::class,"category_th"])->name("category.th");
Route::get("/thfilter/subcategory",[ThController::class,"sub_category_th"])->name("sub.category.th");
Route::get("/thfilter/brand",[ThController::class,"brand_th"])->name("brand.th");
Route::get("/thfilter/shop",[ThController::class,"shop_th"])->name("shop.th");

//custom page
Route::get('custom-page/{slug}', [FrontendController::class, 'custom_page'])->name('frontend.custom.page');


?>
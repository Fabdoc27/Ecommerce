<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ProductSliderController;
use App\Http\Controllers\ProductWishlistController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// brands
Route::get( '/brands', [BrandController::class, 'brandList'] );

// categories
Route::get( '/categories', [CategoryController::class, 'categoryList'] );

// products
Route::get( '/product-brand/{id}', [ProductController::class, 'productListByBrand'] );
Route::get( '/product-category/{id}', [ProductController::class, 'productListByCategory'] );
Route::get( '/product-remark/{remark}', [ProductController::class, 'productListByRemark'] );
Route::get( '/product-details/{id}', [ProductController::class, 'productDetails'] );

// slider
Route::get( '/slider', [ProductSliderController::class, 'productSlider'] );

// review
Route::get( '/review/{product_id}', [ProductReviewController::class, 'productReview'] );
Route::post( '/review', [ProductReviewController::class, 'createReview'] )->middleware( 'token' );

// policy
Route::get( '/policy/{type}', [PolicyController::class, 'PolicyByType'] );

// auth
Route::get( '/user-login/{email}', [UserController::class, 'userLogin'] );
Route::get( '/verify/{email}/{otp}', [UserController::class, 'verifyLogin'] );
Route::get( '/logout', [UserController::class, 'userLogout'] )->name( 'logout' );

// profile
Route::post( '/profile', [CustomerProfileController::class, 'createProfile'] )->middleware( 'token' );
Route::get( '/userProfile', [CustomerProfileController::class, 'getProfile'] )->middleware( 'token' );

// wishlist
Route::get( '/userWishlist', [ProductWishlistController::class, 'wishlist'] )->middleware( 'token' );
Route::get( '/createWishlist/{product_id}', [ProductWishlistController::class, 'createWishlist'] )->middleware( 'token' );
Route::get( '/removeWishlist/{product_id}', [ProductWishlistController::class, 'removeWishlist'] )->middleware( 'token' );

// cart
Route::get( '/cart-list', [ProductCartController::class, 'cartList'] )->middleware( 'token' );
Route::post( '/createCart', [ProductCartController::class, 'createCart'] )->middleware( 'token' );
Route::get( '/removeCart/{product_id}', [ProductCartController::class, 'removeCart'] )->middleware( 'token' );

// invoice
Route::get( '/invoiceList', [InvoiceController::class, 'invoiceList'] )->middleware( 'token' );
Route::get( '/invoice', [InvoiceController::class, 'createInvoice'] )->middleware( 'token' );
Route::get( '/invoice-products/{invoice_id}', [InvoiceController::class, 'invoiceProductsList'] )->middleware( 'token' );

// payment
Route::post( '/paymentSuccess', [InvoiceController::class, 'paymentSuccess'] );
Route::post( '/paymentCancel', [InvoiceController::class, 'paymentCancel'] );
Route::post( '/paymentFailed', [InvoiceController::class, 'paymentFailed'] );

// Page Routes
Route::view( '/', 'home' )->name( 'home' );
Route::view( '/category-product', 'pages.productByCategory' );
Route::view( '/brand-product', 'pages.productByBrand' );
Route::view( '/policies', 'pages.policy' );
Route::view( '/product', 'pages.product' );
Route::view( '/login', 'pages.loginPage' )->name( 'login' );
Route::view( '/verify-login', 'pages.verifyLogin' );
Route::view( '/wishlist', 'pages.userWishlist' )->name( 'wishlist' );
Route::view( '/cart', 'pages.cart' )->name( 'cart' );
Route::view( '/profile-details', 'pages.profile' )->name( 'profile' );
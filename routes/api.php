<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CartController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/login', [LoginController::class, 'loginstore'])->name('login');

Route::middleware('auth.api')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Category

    Route::get('/category', [CategoryController::class, 'category'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'createCategory'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'storeCategory'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('edit.category');
    Route::post('/category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('update.category');
    Route::get('/category/destroy/{id}',[CategoryController::class,'categoryDestroy'])->name('destroy.category');


    // Sub Category

    Route::get('/subcategory', [SubCategoryController::class, 'subcategory'])->name('subcategory');
    Route::get('/subcategory/create', [SubCategoryController::class, 'createsubCategory'])->name('subcategory.create');
    Route::post('/subcategory/store', [SubCategoryController::class, 'storesubCategory'])->name('subcategory.store');
    Route::get('/subcategory/edit/{id}', [SubCategoryController::class, 'Editsubcategory'])->name('edit.subcategory');
    Route::post('/subcategory/update/{id}', [SubCategoryController::class, 'Updatesubcategory'])->name('update.subcategory');
    Route::get('/subcategory/destroy/{id}',[SubCategoryController::class,'Destroysubcategory'])->name('destroy.subcategory');

    // User 

    Route::get('/user', [UserController::class, 'users'])->name('user');
    Route::get('/user/create',[UserController::class,'userCreate'])->name('create.user');
    Route::post('/user/insert',[UserController::class,'userInsert'])->name('insert.user');
    Route::get('/user/edit/{id}', [UserController::class, 'userEdit'])->name('edit.user');
    Route::post('/user/update/{id}', [UserController::class, 'userUpdate'])->name('update.user');
    Route::get('/user/destroy/{id}',[UserController::class,'userDestroy'])->name('destroy.user');

    // Products

    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/product/create',[ProductController::class,'productCreate'])->name('create.product');
    Route::post('/product/insert',[ProductController::class,'productInsert'])->name('insert.product');
    Route::get('/product/edit/{id}', [ProductController::class, 'productEdit'])->name('edit.product');
    Route::post('/product/update/{id}', [ProductController::class, 'productUpdate'])->name('update.product');
    Route::get('/product/destroy/{id}',[ProductController::class,'productDestroy'])->name('destroy.product');

    // Product Image

    Route::get('/productsImage', [ProductImageController::class, 'productsImage'])->name('productsImage');
    Route::get('/productImage/create',[ProductImageController::class,'productCreateImage'])->name('create.productImage');
    Route::post('/productImage/store',[ProductImageController::class,'productInsertImage'])->name('insert.productImage');
    Route::get('/productImage/edit/{id}', [ProductImageController::class, 'productsImageEdit'])->name('edit.productImage');
    Route::post('/productImage/update/{id}', [ProductImageController::class, 'productsImageUpdate'])->name('update.productImage');
    Route::get('/productImage/destroy/{id}',[ProductImageController::class,'productsImageDestroy'])->name('destroy.productImage');

    // Rating

    Route::get('/ratings', [RatingController::class, 'ratings'])->name('ratings');
    Route::get('/rating/create',[RatingController::class,'ratingCreate'])->name('create.rating');
    Route::post('/rating/insert',[RatingController::class,'ratingtInsert'])->name('insert.rating');
    Route::get('/rating/edit/{id}', [RatingController::class, 'ratingEdit'])->name('edit.rating');
    Route::post('/rating/update/{id}', [RatingController::class, 'ratingUpdate'])->name('update.rating');
    Route::get('/rating/destroy/{id}',[RatingController::class,'ratingDestroy'])->name('destroy.rating');

    // Cart

    Route::get('/carts', [CartController::class, 'carts'])->name('carts');
    Route::get('/cart/create',[CartController::class,'cartCreate'])->name('create.cart');
    Route::post('/cart/insert',[CartController::class,'cartInsert'])->name('insert.cart');
    Route::get('/cart/edit/{id}', [CartController::class, 'cartEdit'])->name('edit.cart');
    Route::post('/cart/update/{id}', [CartController::class, 'cartUpdate'])->name('update.cart');
    Route::get('/cart/destroy/{id}',[CartController::class,'cartDestroy'])->name('destroy.cart');


    // WishList

    Route::get('/wishlists', [WishlistController::class, 'wishlists'])->name('wishlists');
    Route::get('/wishlist/create',[WishlistController::class,'wishlistCreate'])->name('create.wishlist');
    Route::post('/wishlist/insert',[WishlistController::class,'wishlistInsert'])->name('insert.wishlist');
    Route::get('/wishlist/edit/{id}', [WishlistController::class, 'wishlistEdit'])->name('edit.wishlist');
    Route::post('/wishlist/update/{id}', [WishlistController::class, 'wishlistUpdate'])->name('update.wishlist');
    Route::get('/wishlist/destroy/{id}',[WishlistController::class,'wishlistDestroy'])->name('destroy.wishlist');


});
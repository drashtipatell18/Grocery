<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SalesMasterController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/loginstore', [HomeController::class, 'loginStore'])->name('loginstore');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

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

// User Address  

Route::get('/user-address', [UserAddressController::class, 'userAddress'])->name('useraddress');
Route::get('/user-address/create',[UserAddressController::class,'userAddressCreate'])->name('create.useraddress');
Route::post('/user-address/insert',[UserAddressController::class,'userAddressInsert'])->name('insert.useraddress');
Route::get('/user-address/edit/{id}', [UserAddressController::class, 'userAddressEdit'])->name('edit.useraddress');
Route::post('/user-address/update/{id}', [UserAddressController::class, 'userAddressUpdate'])->name('update.useraddress');
Route::get('/user-address/destroy/{id}',[UserAddressController::class,'userAddressDestroy'])->name('destroy.useraddress');

Route::get('/user/my/profile', [UserController::class, 'myProfile'])->name('myprofile');
Route::get('/edit-profile/{id}', [UserController::class, 'editProfile'])->name('edit-profile');
Route::post('/update-profile/{id}', [UserController::class, 'Profileupdate'])->name('update-profile');

// Coupon 

Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::get('/coupon/create',[CouponController::class,'couponCreate'])->name('create.coupon');
Route::post('/coupon/insert',[CouponController::class,'couponInsert'])->name('insert.coupon');
Route::get('/coupon/edit/{id}', [CouponController::class, 'couponEdit'])->name('edit.coupon');
Route::post('/coupon/update/{id}', [CouponController::class, 'couponUpdate'])->name('update.coupon');
Route::get('/coupon/destroy/{id}',[CouponController::class,'couponDestroy'])->name('destroy.coupon');

// SalesMaster 

Route::get('/salesmaster', [SalesMasterController::class, 'salesmaster'])->name('salesmaster');
Route::get('/salesmaster/create',[SalesMasterController::class,'salesmasterCreate'])->name('create.salesmaster');
Route::post('/salesmaster/insert',[SalesMasterController::class,'salesmasterInsert'])->name('insert.salesmaster');
Route::get('/salesmaster/edit/{id}', [SalesMasterController::class, 'salesmasterEdit'])->name('edit.salesmaster');
Route::post('/salesmaster/update/{id}', [SalesMasterController::class, 'salesmasterUpdate'])->name('update.salesmaster');
Route::get('/salesmaster/destroy/{id}',[SalesMasterController::class,'salesmasterDestroy'])->name('destroy.salesmaster');
